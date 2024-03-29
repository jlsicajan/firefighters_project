<?php

namespace App\Http\Controllers\Reports;

use App\GasSpend;
use App\StationSpend;
use App\Unity;
use App\UnityData;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\App;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_datas = UnityData::orderBy('created_at', 'DESC')->get();

        $char = $this->generate_char_info();

        $data = ['unity_datas' => $order_datas, 'unities' => Unity::all(), 'char_datas' => $char];
        if (Auth::user()->username == 'edvin' | Auth::user()->username == 'fabian' | Auth::user()->name == 'Administrador' | Auth::user()->username == 'reina') {
            return view('general.index')->with($data);
        } else {
            return 'Error de permiso';
        }
    }

    public function pdf(Request $request)
    {
        $range = $this->convertYmd($request->get('date_from'), $request->get('date_to'));

        $date_from = strtotime($range['ymd_from']);
        $date_to = strtotime($range['ymd_to']);

        $pdf = App::make('dompdf.wrapper');
        if ($request->get('unity') == 'all') {
            $view = $this->pdfAllUnities($date_from, $date_to, $request->get('date_from'), $request->get('date_to'));
        } else {
            $view = $this->pdfOneUnity($date_from, $date_to, $request->get('date_from'), $request->get('date_to'), $request->get('unity'));
        }

        if ($request->get('XLSX')) {
            $this->xlsx($request);
        }

        $date = date('d/m/Y H:i');
        $pdf->loadHTML($view)->setPaper('legal', 'landscape');

        $name_file = $request->get('unity');

        return $pdf->download($name_file . '-' . $date . '.pdf');
    }

    public function load_unity_data_ajax(Request $request)
    {
        $data = [];

        $columns = array(
            0 => 'date',
            1 => 'unity_id',
            2 => 'patient_name',
            3 => 'pilot_id',
            4 => 'asistant_id',
            5 => 'user_id',
            6 => 'patient_input',
            7 => 'patient_case',
            8 => 'kmout',
            9 => 'kmin',
        );

        $total_data = UnityData::count();

        $total_filtered = $total_data;

        $limit = $request->input('length') > 0 ? $request->input('length') : 10;
        $limit = $request->input('length');
        $start = $request->input('start');
//        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $unity_datas = UnityData::take($limit)
                ->skip($start)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $unity_datas =  UnityData::where('date','LIKE',"%{$search}%")
                ->orWhere('unity_id', 'LIKE',"%{$search}%")
                ->orWhere('patient_name', 'LIKE',"%{$search}%")
                ->orWhere('pilot_id', 'LIKE',"%{$search}%")
                ->orWhere('asistant_id', 'LIKE',"%{$search}%")
                ->orWhere('user_id', 'LIKE',"%{$search}%")
                ->orWhere('patient_input', 'LIKE',"%{$search}%")
                ->orWhere('patient_case', 'LIKE',"%{$search}%")
                ->orWhere('kmout', 'LIKE',"%{$search}%")
                ->orWhere('kmin', 'LIKE',"%{$search}%")
                ->limit($limit)
                ->offset($start)
                ->orderBy('created_at', 'DESC')
                ->get();

            $total_filtered = UnityData::where('date','LIKE',"%{$search}%")
                ->orWhere('unity_id', 'LIKE',"%{$search}%")
                ->orWhere('patient_name', 'LIKE',"%{$search}%")
                ->orWhere('pilot_id', 'LIKE',"%{$search}%")
                ->orWhere('asistant_id', 'LIKE',"%{$search}%")
                ->orWhere('user_id', 'LIKE',"%{$search}%")
                ->orWhere('patient_input', 'LIKE',"%{$search}%")
                ->orWhere('patient_case', 'LIKE',"%{$search}%")
                ->orWhere('kmout', 'LIKE',"%{$search}%")
                ->orWhere('kmin', 'LIKE',"%{$search}%")
                ->count();
        }

        if (Auth::user()->username == 'edvin' | Auth::user()->username == 'fabian' | Auth::user()->name == 'Administrador' | Auth::user()->username == 'reina') {
//            $unity_datas = UnityData::orderBy('created_at', 'DESC')->get();
            $data['unity_data'] = [];
            foreach ($unity_datas as $unity_data) {
                // TODO should be changed, this is not a proper way, we need to improve performance, make right relations between models
                $assistant_information = $unity_data->asistant_id != '' ? User::getNameById($unity_data->asistant_id) : 'NINGUN ASISTENTE';//custom messange NINGUN ASISTENTE
                $pilot_information = User::getNameById($unity_data->pilot_id);
                $who_reports = User::getNameById($unity_data->user_id);

                array_push($data['unity_data'], [
                    'DT_RowClass' => 'tr-content',
                    'DT_RowId' => $unity_data->id,
                    $unity_data->date,
                    Unity::getNameById($unity_data->unity_id),
                    $unity_data->patient_name,
                    $pilot_information,
                    $assistant_information,
                    $who_reports,
                    'Q. ' . number_format($unity_data->patient_input, 2) . ' / ' . $unity_data->patient_phone,
                    $unity_data->patient_case . ' / <p style="color: green">' . $unity_data->observations . '</p>',
                    $unity_data->kmout,
                    $unity_data->kmin]);
            }
            
            return ["draw" => intval($request->input('draw')),
                "recordsTotal" => intval($total_data),
                "recordsFiltered" => intval($total_filtered),
                'data' => $data['unity_data'], 'unities' => Unity::all()];
        } else {
            return 'Acceso denegado';
        }
    }

    public function xlsx($request)
    {
        Excel::create('General unidades', function ($excel) use ($request) {

            $excel->sheet('Unidades', function ($sheet) use ($request) {

                $range = $this->convertYmd($request->get('date_from'), $request->get('date_to'));

                $date_from = strtotime($range['ymd_from']);
                $date_to = strtotime($range['ymd_to']);

                if ($request->get('unity') == 'all') {
                    $unity_datas = UnityData::orderBy('created_at', 'ASC')
                        ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                        ->get();
                } else {
                    $unity = Unity::findByCode($request->get('unity'));

                    $unity_datas = UnityData::orderBy('created_at', 'ASC')
                        ->where('unity_id', '=', $unity['id'])
                        ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                        ->get();
                }

                $sheet->fromArray($unity_datas);

            });
        })->export('xls');

    }

    function convertYmd($date_from, $date_to)
    {

        $time_from = substr($date_from, -6);
        $time_to = substr($date_to, -6);

        $date_from = substr($date_from, 0, -7);
        $date_to = substr($date_to, 0, -7);

        $day_to = substr($date_to, 0, -8);
        $month_to = substr($date_to, 3, -5);
        $year_to = substr($date_to, -4);
        $ymd_to = $year_to . '-' . $month_to . '-' . $day_to . ' ' . $time_to;

        $day_from = substr($date_from, 0, -8);
        $month_from = substr($date_from, 3, -5);
        $year_from = substr($date_from, -4);
        $ymd_from = $year_from . '-' . $month_from . '-' . $day_from . ' ' . $time_from;

        return ['ymd_from' => $ymd_from, 'ymd_to' => $ymd_to];
    }

    public function pdfAllUnities($date_from, $date_to, $request_date_from, $request_date_to)
    {
        $unities = Unity::all();

        $unity_datas = [];
        $total_in = [];
        $total_gas_out = [];
        $km_first = [];

        foreach ($unities as $unity) {
            $unity_datas[$unity->code] = UnityData::orderBy('created_at', 'ASC')
                ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                ->where('unity_id', '=', $unity->id)
                ->get();
            $total_in[$unity->code] = UnityData::orderBy('created_at', 'ASC')
                ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                ->where('unity_id', '=', $unity->id)
                ->sum('patient_input');

            $total_gas_out[$unity->code] = GasSpend::orderBy('created_at', 'ASC')
                ->where('unity_id', '=', $unity->id)
                ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                ->sum('gas_spend');

            if (isset($unity_datas[$unity->code][0]->kmout)) {
                $km_first[$unity->code] = $unity_datas[$unity->code][0]->kmout;
            } else {
                $km_first[$unity->code] = 0;
            }
        }
        $total_in_all = UnityData::orderBy('created_at', 'ASC')
            ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
            ->sum('patient_input');

        $total_gas_out_all = GasSpend::orderBy('created_at', 'ASC')
            ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
            ->sum('gas_spend');

        $total_station_out = StationSpend::orderBy('created_at', 'ASC')
            ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
            ->sum('station_spend');

        $data = ['unity_datas' => $unity_datas,
            'date_from' => $request_date_from,
            'date_to' => $request_date_to,
            'total_in' => $total_in,
            'total_gas_out' => $total_gas_out,
            'total_gas_out_all' => $total_gas_out_all,
            'total_station_spends' => $total_station_out,
            'total_in_all' => $total_in_all,
            'unities' => $unities,
            'km_first' => $km_first];

        return \View::make('general.PDF.report_pdf_general')->with($data)->render();
    }

    public function pdfOneUnity($date_from, $date_to, $request_date_from, $request_date_to, $unity_selected)
    {

        $unity = Unity::findByCode($unity_selected);

        $unity_datas = UnityData::orderBy('created_at', 'ASC')
            ->where('unity_id', '=', $unity['id'])
            ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
            ->get();

        $total_in = UnityData::orderBy('created_at', 'ASC')
            ->where('unity_id', '=', $unity['id'])
            ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
            ->sum('patient_input');

        if (isset($unity_datas[0]->kmout)) {
            $km_first = $unity_datas[0]->kmout;
        } else {
            $km_first = 0;
        }
        $data = ['unity_datas' => $unity_datas,
            'date_from' => $request_date_from,
            'date_to' => $request_date_to,
            'unity' => $unity_selected,
            'total_in' => $total_in,
            'km_first' => $km_first,
            'unity_selected' => $unity_selected];

        if ($unity_selected == "TDP22") {
            return \View::make('general.PDF.report_foreach_unity.report_pdf_tdp22')->with($data)->render();
        } else {
            return \View::make('general.PDF.report_foreach_unity.report_pdf_generic')->with($data)->render();
        }
    }

    private function make_char_by_year($year)
    {
        $sqlQuery = "SELECT SQL_NO_CACHE
          general_case,
          MONTH(created_at) AS date,
          COUNT(*) AS quantity,
          YEAR(created_at) AS year_row
          FROM unity_datas
          WHERE YEAR(created_at) = " . $year . " GROUP BY MONTH(created_at), YEAR(created_at), general_case;";
        return DB::select(DB::raw($sqlQuery));
    }

    private function parse_to_highchart_structure($data_to_parse){
        $char = [];
        foreach ($data_to_parse as $result) {
            $char[$result->general_case][$result->date] = $result->quantity;
        }
        foreach ($data_to_parse as $result) {
            for ($y = 1; $y <= ltrim(date('m'), '0'); $y++) {
                if (!isset($char[$result->general_case][$y])) {
                    $char[$result->general_case][$y] = 0;
                }
            }
        }

        return $char;
    }

    public function generate_char_info()
    {

        $results_2017 = $this->make_char_by_year(2017);
        $results_2018 = $this->make_char_by_year(2018);
        $results_2019 = $this->make_char_by_year(2019);
        $results_2020 = $this->make_char_by_year(2020);

        $char = [];
        $char['2017'] = $this->parse_to_highchart_structure($results_2017);
        $char['2018'] = $this->parse_to_highchart_structure($results_2018);
        $char['2019'] = $this->parse_to_highchart_structure($results_2019);
        $char['2020'] = $this->parse_to_highchart_structure($results_2020);

        return $char;
    }
}
