<?php

namespace App\Http\Controllers;

use App\UnityData;
use App\User;
use App\Unity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UnityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($unity)
    {
        $official = User::all();
        $pilots = User::where('username', '=', 'fabian')
            ->orWhere('username', '=', 'juan')
            ->orWhere('username', '=', 'byron')
            ->orWhere('username', '=', 'isabel')
            ->get();
        $data = ['officials' => $official, 'pilots' => $pilots];

        return view('units.' . $unity)->with($data);
    }

    public function save(Request $request)
    {
        $unity = Unity::findByCode(Input::get('unity_id'));

        $unity_data = new UnityData();

        $unity_data->date = Input::get('date');
        $unity_data->timeout = Input::get('timeout');
        $unity_data->timein = Input::get('timein');
        $unity_data->kmout = Input::get('kmout');
        $unity_data->kmin = Input::get('kmin');
        $unity_data->patient_name = Input::get('patient_name');
        $unity_data->patient_responsible = Input::get('patient_responsible');
        $unity_data->patient_age = Input::get('patient_age');
        $unity_data->patient_case = Input::get('patient_case');
        $unity_data->patient_address = Input::get('patient_address');
        $unity_data->patient_address_from = Input::get('patient_address_from');
        $unity_data->patient_destiny = Input::get('patient_destiny');
        if(Input::get('patient_phone') != ''){
            $unity_data->patient_phone = Input::get('patient_phone');
        }
        if(Input::get('patient_input') != ''){
            $unity_data->patient_input = Input::get('patient_input');
        }
        if (Input::get('asistant_id') != 'no_one') {
            $unity_data->asistant_id = Input::get('asistant_id');
        }
        $unity_data->pilot_id = Input::get('pilot_id');
        $unity_data->unity_id = $unity['id'];
        $unity_data->user_id = Auth::user()->id;
        $unity_data->general_case = Input::get('general_case');
        $unity_data->save();

        return 'Unidad ' . Input::get('unity_id') . ' ingresado correctamente';
    }
}
