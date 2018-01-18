<?php

namespace App\Http\Controllers\Reports;

use App\Collection;
use App\GasSpend;
use App\StationSpend;
use App\UnityData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountingController extends Controller
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


    public function index()
    {
        $dates = $this->clasificate_dates();
        if (Auth::user()->username == 'edvin' | Auth::user()->username == 'fabian' | Auth::user()->name == 'Administrador' | Auth::user()->username == 'reina') {
            return view('general.accounting.index')->with(compact('dates'));
        } else {
            return 'Error de permiso';
        }

    }

    public function get_first_date(){
        //get all the created at values of the tables that have spends or revenue
        $first_data_of_unity_datas = strtotime(UnityData::all()->min('created_at'));
        $first_data_of_gas_spends = strtotime(GasSpend::all()->min('created_at'));
        $first_data_of_station_spends = strtotime(StationSpend::all()->min('created_at'));
        $first_data_of_collections = strtotime(Collection::all()->min('created_at'));

        $all_firsts_months = [$first_data_of_unity_datas, $first_data_of_gas_spends, $first_data_of_station_spends, $first_data_of_collections];
        return min($all_firsts_months);
    }

    public function clasificate_dates(){
        $output = [];
        $from   = $this->get_first_date();
        $last   = date('m-Y', time());

        do {
            $month = date('m-Y', $from);
            $total = date('t', $from);

            $output[] = [
                'date' => $month,
                'total' => $total,
            ];

            $from = strtotime('+1 month', $from);
        } while ($month != $last);


        return array_reverse($output);
    }
}
