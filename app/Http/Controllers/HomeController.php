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
        $users = User::all();

        return view('home')->with(['users' => $users]);
    }

    public function new_index() {
        //Identificar que usuario esta logeado

        $user_id_logged = Auth::user()->id; //id del usuario
        $user = User::find($user_id_logged); //SELECT * FROM user WHERE id = 1;
        $casc_number = $user->number;
        $email = $user->email;

        return view('new_home', array('casc_number' => $casc_number, 'user_id_logged' => $user_id_logged,
                                            'email' => $email));
    }

    public function reina_index(){
        return view('reina_home');
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

    public function users_ajax()
    {
        $users_datas = $leagues = DB::table('users')
            ->select('league_name')
            ->join('countries', 'countries.country_id', '=', 'leagues.country_id')
            ->where('countries.country_name', $country)
            ->get();

        $users_datas = User::all();

        $data = [];
        foreach ($users_datas as $user) {
            array_push($data, ['DT_RowClass' => 'tr-content', 'DT_RowId' => $user->id, $user->name, $user->username, $user->number, $user->email]);
        }
        return ['data' => $data];
    }
}
