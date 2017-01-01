<?php

namespace App\Http\Controllers;

use App\Unity;
use App\UnityData;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\App;

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
//        $date_from= date("Y/d/m", strtotime($request->get('date_from')));
//        $date_to = date("Y/d/m", strtotime($request->get('date_to')));
//        $year = $request->get('year');
//        $unity_select = $request->get('unity');
//
//        if ($unity_select == 'all') {
//            $unity_datas = UnityData::orderBy('date')
//                ->where('date', 'LIKE', '%'.[$date_from, $date_to])
//                ->get();
//        } else {
//            $unity = Unity::findByCode($unity_select);
//
//            $unity_datas = UnityData::where('unity_id', '=', $unity['id'])
//                ->where('date', 'LIKE', '%'.[$date_from, $date_to])
//                ->get();
//        }

        $data = ['unity_datas' => UnityData::all()];
        $pdf = App::make('dompdf.wrapper');
        $view = \View::make('general.PDF.report_pdf_general')->with($data)->render();
        $date = date('Y-m-d');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');

        return $pdf->download('general-' . $date . '.pdf');
    }

//    function dateRange( $first, $last, $step, $format ) {
//
//        $dates = array();
//        $current = strtotime( $first );
//        $last = strtotime( $last );
//
//        while( $current <= $last ) {
//
//            $dates[] = date( $format, $current );
//            $current = strtotime( $step, $current );
//        }
//
//        return $dates;
//    }
}
