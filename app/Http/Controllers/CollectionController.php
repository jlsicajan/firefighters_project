<?php

namespace App\Http\Controllers;

use App\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CollectionController extends Controller
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
        return view('collections.index');
    }

    public function saveCollection(Request $request){
        $collection = new Collection();
        $collection->user_id = Auth::user()->id;
        $collection->date = Input::get('date');
        $collection->quantity = Input::get('quantity');
        $collection->description = Input::get('description');
        $collection->save();

        return 'Recaudacion ingresado correctamente ' . $collection->number;
    }
}
