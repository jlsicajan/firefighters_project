<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
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
        return view('home');
    }

    public function changePassword(){
        return view('change_password');
    }

    public function newPassword(Request $request){
        if(Input::get('new_password') != Input::get('confirm_new_password')){
            return response()->json(['error' => 'Las contraseñas que ingreso no coinciden'], 404);
        }

        if (Auth::attempt(array('name' => Auth::user()->name, 'password' => Input::get('old_password'))))
        {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt(Input::get('new_password'));
            $user->save();
            Auth::logout();
            return 'Se cambio su contraseña correctamente';
        }else{
            return response()->json(['error' => 'La contraseña que ingreso no es la actual'], 404);
        }
    }
}
