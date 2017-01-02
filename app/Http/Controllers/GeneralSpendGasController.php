<?php

namespace App\Http\Controllers;

use App\GasSpend;
use App\Unity;
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

}
