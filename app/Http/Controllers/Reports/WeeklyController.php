<?php

namespace App\Http\Controllers\Reports;

use App\WeeklyControl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class WeeklyController extends Controller
{
    public function index()
    {
        $data = ['reintegrate_sum' => WeeklyControl::all()->sum('reintegrate'),
                 'gain_sum' => WeeklyControl::all()->sum('gain')];
        if (Auth::user()->username == 'edvin' | Auth::user()->username == 'fabian' | Auth::user()->name == 'Administrador' | Auth::user()->name == 'reina') {
            return view('general.weekly.index')->with($data);
        } else {
            return 'Error de permiso';
        }
    }
    public function save(){

        $date_convert = $this->convertYmd(Input::get('date_from'), Input::get('date_to'));

        $weekly_control = new WeeklyControl();
        $weekly_control->date_from = Carbon::parse($date_convert['ymd_from']);
        $weekly_control->date_to = Carbon::parse($date_convert['ymd_to']);
        $weekly_control->reintegrate = Input::get('reintegrate');
        $weekly_control->gain = Input::get('gain');
        $weekly_control->save();
        $data = array('message' => 'Dato ingresado correctamente.', 'reintegrate_sum' => WeeklyControl::all()->sum('reintegrate'),
                      'gain_sum' => WeeklyControl::all()->sum('gain'));
        return $data;
    }

    function convertYmd($date_from, $date_to)
    {
        $time_from = substr($date_from, -9);
        $time_to = substr($date_to, -9);

        $date_from = substr($date_from, 0, -10);
        $date_to = substr($date_to, 0, -10);

        $day_to = substr($date_to, 0, -8);
        $month_to = substr($date_to, 3, -5);
        $year_to = substr($date_to, -4);
        $ymd_to = $year_to . '-' . $month_to . '-' . $day_to . ' ' . $time_to;

        $day_from = substr($date_from, 0, -8);
        $month_from = substr($date_from, 3, -5);
        $year_from = substr($date_from, -4);
        $ymd_from = $year_from . '-' . $month_from . '-' . $day_from . ' ' . $time_from;

        return ['ymd_from' => $ymd_from, 'ymd_to' => $ymd_to];
    }
    public function ajax()
    {
        $weekly_datas = WeeklyControl::all();
        $data = [];
        foreach ($weekly_datas as $weekly_data){
            array_push($data, ['DT_RowClass' => 'tr-content', 'DT_RowId' => $weekly_data->id, $weekly_data->date_from->format('d/m/Y H:i:s'),
                $weekly_data->date_to->format('d/m/Y  H:i:s'), $weekly_data->reintegrate, $weekly_data->gain]);
        }
        return ['data' => $data];
    }
}
