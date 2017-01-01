<?php

namespace App\Http\Controllers;

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
        $data = array('unity_datas' => UnityData::all());
        return view('general.index')->with($data);
    }

    public function pdf(){
        $data = array('unity_datas' => UnityData::all());
        $pdf = App::make('dompdf.wrapper');
        $view =  \View::make('general.PDF.report_pdf_general')->with($data)->render();
        $date = date('Y-m-d');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');
        return $pdf->download('general-'. $date . '.pdf');
    }
}
