<?php

namespace App\Http\Controllers;

use App\UnityData;
use App\User;
use Illuminate\Http\Request;
use DB;

class GeneralController extends Controller
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
        $data = array('unity_datas' => UnityData::all());
        return view('general.index')->with($data);
    }
}
