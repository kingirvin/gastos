<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Devolucion;
use App\Garantia;
use App\User;
use Auth;
use DataTables;

class DevolucionController extends Controller
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
        $lista=Devolucion::get();
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    { 
        //return $request;
        $user=Auth::user();
        if($request->id!="0"){
            $devolucion=Devolucion::find($request->id);
            $devolucion->nro=$request->nro;
            $devolucion->reg_siaf=$request->siaf;
            $devolucion->periodo=$request->periodo;
            $devolucion->cheque=$request->cheque;
            $devolucion->monto=$request->monto;
            $devolucion->observacion=$request->observacion;
            $devolucion->user_id=$user->id;
            $devolucion->garantia_id=$request->garantia_id;
        }
        else{
            $devolucion=new Devolucion;
            $devolucion->nro=$request->nro;
            $devolucion->reg_siaf=$request->siaf;
            $devolucion->periodo=$request->periodo;
            $devolucion->cheque=$request->cheque;
            $devolucion->monto=$request->monto;
            $devolucion->observacion=$request->observacion;
            $devolucion->user_id=$user->id;
            $devolucion->estado="1";
            $devolucion->garantia_id=$request->garantia_id;

        }
        if($devolucion->save()){
            $garantia=Garantia::find($request->garantia_id);
            $garantia->estado ="0";
            $garantia->save();
            return response()->json(['message'=>'Se guardo correctamente'], 200);            
        }
        else
            return response()->json(['message'=>'Error, no se guardaron los datos'], 500);

    }
    public function buscar(Request $request){
        //return $request;
        return devolucion::find($request->id);
    }
}
