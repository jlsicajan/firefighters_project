<?php

namespace App\Http\Controllers;

use App\StationSpend;
use Illuminate\Http\Request;

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
}
