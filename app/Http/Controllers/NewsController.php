<?php

namespace App\Http\Controllers;

use App\NewDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
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
    public function index(Request $request)
    {
        return view('news.index');
    }

    public function saveNew(Request $request){
        $new = new NewDay();
        $new->user_id = Auth::user()->id;
        $new->date = Input::get('date');
        $new->news_day = Input::get('news_day');
        $new->save();
        return 'Novedad ingresado correctamente con fecha ' . $new->date;
    }
}
