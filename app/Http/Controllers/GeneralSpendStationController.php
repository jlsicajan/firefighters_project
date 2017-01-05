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
    $total_station_general = StationSpend::all()->sum('station_spend');
    $data = ['station_spends' => StationSpend::all(), 'total_station_general' => $total_station_general];
    $pdf = App::make('dompdf.wrapper');
    $view = \View::make('general.PDF.report_pdf_spend_station')->with($data)->render();
    $date = date('Y-m-d');
    $pdf->loadHTML($view)->setPaper('a4', 'landscape');

    return $pdf->download('gastos-estacion-' . $date . '.pdf');
  }
}
