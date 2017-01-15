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

        $date_from = strtotime($range['ymd_from']);
        $date_to = strtotime($range['ymd_to']);
        if ($request->get('unity') == 'all') {
            $unity_datas = UnityData::orderBy('date')
                ->whereBetween('created_at', [date('Y-m-d H:i:s', $date_from), date('Y-m-d H:i:s', $date_to)])
                ->get();

            $total_in = UnityData::orderBy('date')
                ->whereBetween('created_at', [$date_from, $date_to])
                ->sum('patient_input');
        } else {
            $unity = Unity::findByCode($request->get('unity'));

            $unity_datas = UnityData::orderBy('date')
                ->where('unity_id', '=', $unity['id'])
                ->where(function ($query) use($range) {
                    for ($i = 0; $i < count($range); $i++){
                        $query->orwhere('date', 'like',  $range[$i] .'%');
                    }})
                ->get();

            $total_in = UnityData::orderBy('date')
                ->where('unity_id', '=', $unity['id'])
                ->where(function ($query) use($range) {
                    for ($i = 0; $i < count($range); $i++){
                        $query->orwhere('date', 'like',  $range[$i] .'%');
                    }})
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

        return array('ymd_from' => $ymd_from, 'ymd_to' => $ymd_to);
    }
}
