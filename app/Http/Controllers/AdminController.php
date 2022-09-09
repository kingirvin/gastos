<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devolucion;
use App\Garantia;
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
    public function devolucion()
    {
        $devolucion=Devolucion::get();
        $menu='Devolucion';
        $garantias=garantia::select('id','oc_os as text')->get();
        return view('devolucion.devolucion',compact('menu','garantias'));
    }       
    public function garantia()
    {
        $menu='Garantia';
        return view('garantia.garantia',compact('menu'));
    }
    public function error_estado(){
        return view('administrador.error_estado');
    }
}
