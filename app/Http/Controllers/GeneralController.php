<?php

namespace App\Http\Controllers;

use App\Unity;
use App\UnityData;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\App;
use Faker\Provider\cs_CZ\DateTime;

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
        $data = ['unity_datas' => UnityData::all(), 'unities' => Unity::all()];

        return view('general.index')->with($data);
    }

    public function pdf(Request $request)
    {
        $range = $this->convertYmd($request->get('date_from'), $request->get('date_to'));

        if ($request->get('unity') == 'all') {
            $unity_datas = UnityData::orderBy('date')
                ->whereIn('date', $range)
                ->get();

            $total_in = UnityData::orderBy('date')
                ->whereIn('date', $range)
                ->sum('patient_input');
        } else {
            $unity = Unity::findByCode($request->get('unity'));

            $unity_datas = UnityData::orderBy('date')
                ->where('unity_id', '=', $unity['id'])
                ->whereIn('date', $range)
                ->get();

            $total_in = UnityData::orderBy('date')
                ->where('unity_id', '=', $unity['id'])
                ->whereIn('date', $range)
                ->sum('patient_input');
        }

        $data = ['unity_datas' => $unity_datas,
                 'date_from'   => $request->get('date_from'),
                 'date_to'     => $request->get('date_to'),
                 'unity'       => $request->get('unity'),
                 'total_in'    => $total_in];

        $pdf = App::make('dompdf.wrapper');
        $view = \View::make('general.PDF.report_pdf_general')->with($data)->render();
        $date = date('Y-m-d');
        $pdf->loadHTML($view)->setPaper('letter', 'landscape');

        return $pdf->download('general-' . $date . '.pdf');
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
