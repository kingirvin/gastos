<?php

namespace App\Http\Controllers\Auth;
use Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectTo() {
        $tipo = Auth::user()->tipo_id; 
        if(Auth::user()->estado==1){
            if($tipo == 1){//publico
                return '/vista/usuarios'; 
            }        
            elseif(Auth::user()->oficina=="Garantias"||Auth::user()->oficina=="Devoluciones")//Garantias
                return '/vista/garantias';            
            else//comprobantes
                return '/vista/garantiasDe';
        }  
        else
            return 'vista/error_estado';            
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
