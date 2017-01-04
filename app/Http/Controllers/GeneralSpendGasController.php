<?php

namespace App\Http\Controllers;

use App\GasSpend;
use App\Unity;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

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
    $data = ['gas_datas' => GasSpend::all(), 'unities' => Unity::all()];
    return view('general.spend_gas.index')->with($data);
  }

  public function pdf(Request $request)
  {

    $data = ['gas_spends' => GasSpend::all()];
    $pdf = App::make('dompdf.wrapper');
    $view = \View::make('general.PDF.report_pdf_spend_gas')->with($data)->render();
    $date = date('Y-m-d');
    $pdf->loadHTML($view)->setPaper('a4', 'landscape');

    return $pdf->download('gastos-combustible-' . $date . '.pdf');
  }
}
