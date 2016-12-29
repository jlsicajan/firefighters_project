<?php

namespace App\Http\Controllers;

use App\GasSpend;
use App\Providers\AuthServiceProvider;
use App\StationSpend;
use App\Unity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
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
    public function gas(Request $request)
    {
        $unities = Unity::all();
        $data = array('unities' => $unities);
        return view('gas.index')->with($data);
    }

    public function station()
    {
        return view('station.index');
    }

    public function saveGas(Request $request){
        $unity = Unity::findByCode(Input::get('unity'));
        $gas_spend = new GasSpend();
        $gas_spend->unity_id = $unity['id'];
        $gas_spend->user_id = Auth::user()->id;
        $gas_spend->bill_number = Input::get('bill_number');
        $gas_spend->gas_name = Input::get('gas_name');
        $gas_spend->gas_spend = Input::get('gas_spend');
        $gas_spend->note_gas = Input::get('note_gas');
        $gas_spend->save();
        return 'Gasto ingresado correctamente Q' . $gas_spend->gas_spend;
    }

    public function saveStation(Request $request){
        $station_spend = new StationSpend();
        $station_spend->user_id = Auth::user()->id;
        $station_spend->bill_number = Input::get('bill_number');
        $station_spend->station_spend = Input::get('station_spend');
        $station_spend->description = Input::get('description');
        $station_spend->save();
        return 'Gasto ingresado correctamente Q' . $station_spend->station_spend;
    }
}
