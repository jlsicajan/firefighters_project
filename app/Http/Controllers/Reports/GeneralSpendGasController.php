<?php

namespace App\Http\Controllers\Reports;

use App\GasSpend;
use App\Unity;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GeneralSpendGasController extends Controller
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
        $data = ['gas_datas' => GasSpend::orderBy('created_at', 'DESC')->get(), 'unities' => Unity::all()];
        if(Auth::user()->username == 'edvin' | Auth::user()->username == 'fabian'| Auth::user()->name == 'Administrador' | Auth::user()->username == 'reina'){
            return view('general.spend_gas.index')->with($data);
        }else{
            return 'Error de permiso';
        }
    }

    public function pdf(Request $request)
    {
        $range = $this->convertYmd($request->get('date_from'), $request->get('date_to'));
        $date_from = strtotime($range['ymd_from']);
        $date_to = strtotime($range['ymd_to']);

        if ($request->get('unity') == 'all') {
            $gas_spends = GasSpend::orderBy('created_at', 'ASC')
                ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                ->get();

            $total_gas_general = GasSpend::orderBy('created_at', 'ASC')
                ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                ->sum('gas_spend');
        } else {
            $unity = Unity::findByCode($request->get('unity'));

            $gas_spends = GasSpend::orderBy('created_at', 'ASC')
                ->where('unity_id', '=', $unity['id'])
                ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                ->get();

            $total_gas_general = GasSpend::orderBy('created_at', 'ASC')
                ->where('unity_id', '=', $unity['id'])
                ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                ->sum('gas_spend');
        }


        $data = ['gas_spends'        => $gas_spends,
                 'date_from'         => $request->get('date_from'),
                 'date_to'           => $request->get('date_to'),
                 'unity'             => $request->get('unity'),
                 'total_gas_general' => $total_gas_general];

        $pdf = App::make('dompdf.wrapper');
        $view = \View::make('general.PDF.report_pdf_spend_gas')->with($data)->render();
        $date = date('Y-m-d');
        $pdf->loadHTML($view)->setPaper('legal', 'landscape');

        return $pdf->download('gastos-combustible-' . $date . '.pdf');
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
}
