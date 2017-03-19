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
        $official = User::whereNotIn('username', ['admin', 'admin@sicajan.com'])->orderBy('name', 'ASC')->get();
        $pilots = User::where('username', '=', 'fabian')
            ->orWhere('username', '=', 'juan')
            ->orWhere('username', '=', 'byron')
            ->orWhere('username', '=', 'isabel')
            ->orWhere('username', '=', 'david')
            ->orWhere('username', '=', 'narciso')
            ->orWhere('username', '=', 'edson')
            ->get();
        if ($unity == 'rd') {
            $kmin_all = UnityData::where('unity_id', '=', Unity::findByCode('RD19'))->select('kmin')->orderBy('created_at', 'desc')->first();
        } else {
            $kmin_all = UnityData::where('unity_id', '=', Unity::findByCode(strtoupper($unity)))->select('kmin')->orderBy('created_at', 'desc')->first();
        }
        $kmin_all = isset($kmin_all) ? $kmin_all->kmin : '';

        $data = ['officials' => $official, 'pilots' => $pilots,
                 'kmin_all'  => $kmin_all, 'date_today' => date('d/m/Y H:i:s')
        ];

        return view('units.' . $unity)->with($data);
    }

    public function save(Request $request)
    {
        $unity = Unity::findByCode(Input::get('unity_id'));

        $unity_data = new UnityData();

        if (Input::get('is_water') == true) {
            $unity_data->date = date('d/m/Y H:i:s');
            $unity_data->timeout = Input::get('timeout');
            $unity_data->timein = Input::get('timein');
            $unity_data->kmout = Input::get('kmout');
            $unity_data->kmin = Input::get('kmin');
            $unity_data->patient_name = ' ';
            $unity_data->patient_age = 0;
            $unity_data->patient_case = ' ';
            $unity_data->patient_address = ' ';
            $unity_data->patient_address_from = ' ';
            $unity_data->patient_destiny = ' ';
            if (Input::get('patient_phone') != '') {
                $unity_data->patient_phone = Input::get('patient_phone');
            }
            if (Input::get('patient_input') != '') {
                $unity_data->patient_input = Input::get('patient_input');
            }
            if (Input::get('asistant_id') != 'no_one') {
                $unity_data->asistant_id = Input::get('asistant_id');
            }
            if (Input::get('asistant_id_two') != 'no_one') {
                $unity_data->asistant_id_two = Input::get('asistant_id_two');
            }
            $unity_data->pilot_id = Input::get('pilot_id');
            $unity_data->unity_id = $unity['id'];
            $unity_data->user_id = Auth::user()->id;
            $unity_data->general_case = Input::get('general_case');
            $unity_data->observations = Input::get('observations');

            $unity_data->service_type = ' ';

            $unity_data->water_destiny = Input::get('water_destiny');
            $unity_data->water_spend = Input::get('water_spend');
            $unity_data->fill_unity = Input::get('fill_unity');
            $unity_data->spend_aport = Input::get('spend_aport');
            $unity_data->fill_spend = Input::get('fill_spend');

            $unity_data->save();

            $data = ['message' => 'Unidad ' . Input::get('unity_id') . ' ingresado correctamente', 'kmall' => $unity_data->kmin];

            return $data;
        }

        $unity_data->date = date('d/m/Y H:i:s');
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
        if (Input::get('patient_phone') != '') {
            $unity_data->patient_phone = Input::get('patient_phone');
        }
        if (Input::get('patient_input') != '') {
            $unity_data->patient_input = Input::get('patient_input');
        }
        if (Input::get('asistant_id') != 'no_one') {
            $unity_data->asistant_id = Input::get('asistant_id');
        }
        if (Input::get('asistant_id_two') != 'no_one') {
            $unity_data->asistant_id_two = Input::get('asistant_id_two');
        }
        $unity_data->pilot_id = Input::get('pilot_id');
        $unity_data->unity_id = $unity['id'];
        $unity_data->user_id = Auth::user()->id;
        $unity_data->general_case = Input::get('general_case');
        $unity_data->observations = Input::get('observations');
        //FOR SECURITY SET DATA DEFAULT FOR NOW
        $unity_data->water_destiny = ' ';
        $unity_data->water_spend = ' ';
        $unity_data->fill_unity = ' ';
        $unity_data->spend_aport = ' ';
        $unity_data->fill_spend = 0;

        // FOR SERVICE SOCIAL ADD SERVICE TYPE
        if (Input::get('service_type') != '') {
            $unity_data->service_type = Input::get('service_type');
        } else {
            $unity_data->service_type = ' ';
        }
        $unity_data->save();

        $data = ['message' => 'Unidad ' . Input::get('unity_id') . ' ingresado correctamente', 'kmall' => $unity_data->kmin];

        return $data;
    }

    public function find($id)
    {
        $unity_data = UnityData::find($id);

        return view('general.unity_datas.modals.unityDetailModal', ['unity_data' => $unity_data])->render();
    }
}
