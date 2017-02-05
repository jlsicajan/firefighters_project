<?php

namespace App\Http\Controllers\Reports;

use App\StationSpend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GeneralSpendStationController extends Controller
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
        $data = ['station_datas' => StationSpend::orderBy('created_at', 'DESC')->get()];
        if(Auth::user()->username == 'edvin' | Auth::user()->username == 'fabian'| Auth::user()->name == 'Administrador'){
            return view('general.spend_station.index')->with($data);
        }else{
            return 'Error de permiso';
        }

    }

    public function pdf(Request $request)
    {
        $range = $this->convertYmd($request->get('date_from'), $request->get('date_to'));
        $date_from = strtotime($range['ymd_from']);
        $date_to = strtotime($range['ymd_to']);

        $station_spends = StationSpend::orderBy('created_at', 'ASC')
            ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
            ->get();

        $total_station_general = StationSpend::orderBy('created_at', 'ASC')
            ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
            ->sum('station_spend');

        $data = ['station_spends'        => $station_spends,
                 'date_from'             => $request->get('date_from'),
                 'date_to'               => $request->get('date_to'),
                 'total_station_general' => $total_station_general];

        $pdf = App::make('dompdf.wrapper');
        $view = \View::make('general.PDF.report_pdf_spend_station')->with($data)->render();
        $date = date('Y-m-d');
        $pdf->loadHTML($view)->setPaper('legal', 'landscape');

        return $pdf->download('gastos-estacion-' . $date . '.pdf');
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
