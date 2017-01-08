<?php

namespace App\Http\Controllers;

use App\StationSpend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        $data = ['station_datas' => StationSpend::all()];

        return view('general.spend_station.index')->with($data);
    }

    public function pdf(Request $request)
    {
        $range = $this->convertYmd($request->get('date_from'), $request->get('date_to'));

        $station_spends = StationSpend::orderBy('date')
            ->whereIn('date', $range)
            ->get();

        $total_station_general = StationSpend::orderBy('date')
            ->whereIn('date', $range)
            ->sum('station_spend');

        $data = ['station_spends'        => $station_spends,
                 'date_from'             => $request->get('date_from'),
                 'date_to'               => $request->get('date_to'),
                 'total_station_general' => $total_station_general];

        $pdf = App::make('dompdf.wrapper');
        $view = \View::make('general.PDF.report_pdf_spend_station')->with($data)->render();
        $date = date('Y-m-d');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');

        return $pdf->download('gastos-estacion-' . $date . '.pdf');
    }

    function createDateRangeArray($strDateFrom, $strDateTo)
    {
        $aryRange = [];

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('d/m/Y', $iDateFrom)); // first entry
            while ($iDateFrom < $iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($aryRange, date('d/m/Y', $iDateFrom));
            }
        }

        return $aryRange;
    }

    function convertYmd($date_from, $date_to)
    {
        $day_to = substr($date_to, 0, -8);
        $month_to = substr($date_to, 3, -5);
        $year_to = substr($date_to, -4);
        $ymd_to = $year_to . '-' . $month_to . '-' . $day_to;

        $day_from = substr($date_from, 0, -8);
        $month_from = substr($date_from, 3, -5);
        $year_from = substr($date_from, -4);
        $ymd_from = $year_from . '-' . $month_from . '-' . $day_from;

        return $this->createDateRangeArray($ymd_from, $ymd_to);
    }
}
