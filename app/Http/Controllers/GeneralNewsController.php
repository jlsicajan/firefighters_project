<?php

namespace App\Http\Controllers;

use App\NewDay;
use Illuminate\Http\Request;

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
        return view('general.news.index')->with($data);
    }

}
