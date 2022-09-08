<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Giro;
use App\Conciliacion;
use App\User;
use Auth; 
class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');        
    }        
    public function usuario()
    {
        $user=Auth::user();
        $menu='Usuarios';
        return view('administrador.usuarios', compact('menu'));
    }       
    public function giro()
    {
        $giro=Giro::get();
        $menu='Giros';
        $conciliaciones=Conciliacion::select('id','oc_os as text')->get();
        return view('giro.giro',compact('menu','conciliaciones'));
    }       
    public function conciliacion()
    {
        $menu='Conciliaciones';
        return view('conciliacion.conciliacion',compact('menu'));
    }
}
