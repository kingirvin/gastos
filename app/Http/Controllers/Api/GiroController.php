<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Giro;
use App\Conciliacion;
use App\User;
use Auth;
use DataTables;

class GiroController extends Controller
{
    //
    //
    public function __construct()
    {
        $this->middleware('auth');        
    }    
    public function listar() 
    { 
        //3:ADMIN, 2:INSTITUCIONAL, 1:EMPRESA, 0:PUBLICO
        $lista=Giro::get();
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    { 
        //return $request;
        $user=Auth::user();
        $giro=new Giro;
        $giro->nro=$request->nro;
        $giro->reg_siaf=$request->siaf;
        $giro->periodo=$request->periodo;
        $giro->cheque=$request->cheque;
        $giro->monto=$request->monto;
        $giro->estado=$request->estado;
        $giro->observacion=$request->observacion;
        $giro->user_id=$user->id;
        $giro->estado="1";
        $giro->conciliacion_id=$request->id;
        $giro->save();        
        if($giro->save()){
            $conciliacion=Conciliacion::find($request->id);
            $conciliacion->estado ="0";
            $conciliacion->save();
            return response()->json(['message'=>'Se guardo correctamente'], 200);            
        }
        else
            return response()->json(['message'=>'Error, no se guardaron los datos'], 500);

    }
}
