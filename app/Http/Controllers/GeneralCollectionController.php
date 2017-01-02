<?php

namespace App\Http\Controllers;

use App\Collection;
use Illuminate\Http\Request;

class GeneralCollectionController extends Controller
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
        $data = ['collection_datas' => Collection::all()];
        return view('general.collections.index')->with($data);
    }
}
