<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UnityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($unity)
    {
        $official = User::all();
        $data = array('officials' => $official);
        return view('units.' . $unity)->with($data);
    }

    public function save(Request $request){
        return 'Guardado correctamente';
    }
}
