<?php

namespace App\Http\Controllers\Reports;

use App\NewDay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GeneralNewsController extends Controller
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
        $data = ['new_datas' => NewDay::all()];
        if(Auth::user()->username == 'edvin' | Auth::user()->username == 'fabian' | Auth::user()->name == 'Administrador' | Auth::user()->username == 'reina'){
            return view('general.news.index')->with($data);
        }else{
            return 'Error de permiso';
        }

    }

}
