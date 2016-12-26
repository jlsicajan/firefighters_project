<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($unity)
    {
        return view('units.' . $unity);
    }
}
