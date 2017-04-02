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
        $data = array('unities' => $unities, 'date_today' => date('d/m/Y H:i:s'));
        return view('gas.index')->with($data);
    }

    public function station()
    {
        $data = array('date_today' => date('d/m/Y H:i:s'));
        return view('station.index')->with($data);
    }

    public function saveGas(Request $request){
        $path_file = $this->upload_any_pdf($request->allFiles());
        date_default_timezone_set('America/Guatemala');

        $unity = Unity::findByCode(Input::get('unity'));
        $gas_spend = new GasSpend();
        $gas_spend->unity_id = $unity['id'];
        $gas_spend->user_id = Auth::user()->id;
        $gas_spend->bill_number = Input::get('bill_number');
        $gas_spend->gas_name = Input::get('gas_name');
        $gas_spend->gas_spend = Input::get('gas_spend');
        $gas_spend->note_gas = Input::get('note_gas');
        $gas_spend->date = date('d/m/Y H:i:s');
        $gas_spend->path_photo = $path_file;
        $gas_spend->save();
        return 'Gasto ingresado correctamente Q' . $gas_spend->gas_spend;
    }

    public function saveStation(Request $request){
        $station_spend = new StationSpend();
        $station_spend->user_id = Auth::user()->id;
        $station_spend->bill_number = Input::get('bill_number');
        $station_spend->station_spend = Input::get('station_spend');
        $station_spend->description = Input::get('description');
        $station_spend->date = date('d/m/Y H:i:s');
        $station_spend->save();
        return 'Gasto ingresado correctamente Q' . $station_spend->station_spend;
    }

    private function upload_any_pdf($files){
        foreach ($files as $file){
          $destinationPath = public_path('gas/photo/' . Auth::user()->id . '/');
          // Get the orginal filname or create the filename of your choice
          $filename = $file->getClientOriginalName();
          // TODO: Criteria with the uploads
          // Copy the file in our upload folder
          $file->move($destinationPath, $filename);
          // Return uploaded file path
          return '/gas/photo/' . Auth::user()->id . '/' . $filename;
        }
    }
}
