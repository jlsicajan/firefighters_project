<?php

namespace App\Http\Controllers\Reports;

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

        $data = ['unity_datas' => $order_datas, 'unities' => Unity::all()];
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

            if (isset($unity_datas[$unity->code][0]->kmout)) {
                $km_first[$unity->code] = $unity_datas[$unity->code][0]->kmout;
            } else {
                $km_first[$unity->code] = 0;
            }
        }
        $total_in_all = UnityData::orderBy('created_at', 'ASC')
            ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
            ->sum('patient_input');

        $data = ['unity_datas' => $unity_datas,
                 'date_from'   => $request_date_from,
                 'date_to'     => $request_date_to,
                 'total_in'    => $total_in,
                 'total_in_all'    => $total_in_all,
                 'unities'     => $unities,
                 'km_first'    => $km_first];

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
                 'date_from'   => $request_date_from,
                 'date_to'     => $request_date_to,
                 'unity'       => $unity_selected,
                 'total_in'    => $total_in,
                 'km_first'    => $km_first];

        switch ($unity_selected) {
            case "TDP22":
                return \View::make('general.PDF.report_foreach_unity.report_pdf_tdp22')->with($data)->render();
            case "AD21":
                return \View::make('general.PDF.report_foreach_unity.report_pdf_ad21')->with($data)->render();
            case "RD19":
                return \View::make('general.PDF.report_foreach_unity.report_pdf_rd19')->with($data)->render();
            case "MDP22":
                return \View::make('general.PDF.report_foreach_unity.report_pdf_mdp22')->with($data)->render();
            case "EE22":
                return \View::make('general.PDF.report_foreach_unity.report_pdf_ee22')->with($data)->render();
        }
    }
}
