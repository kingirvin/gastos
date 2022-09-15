<?php

namespace App\Http\Controllers\Api;

use App\Devolucion;
use App\Garantia;
use App\Proveedor;
use App\User;
use Auth;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');        
    }    
    public function listar($buscar) 
    { 
        //3:ADMIN, 2:INSTITUCIONAL, 1:EMPRESA, 0:PUBLICO

         if($buscar=="")
            $lista=Proveedor::select('id','nombre as nombre','ruc')->get();   
        else
            $lista=Proveedor::select('id','nombre as nombre','ruc')->where('nombre',"like",'%'.$buscar.'%')->get();   
        return response()->json(['data'=>$lista]);   
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
        return Devolucion::find($request->id);
    }
    public function reporteBuscar(Request $request){
              
        $devoluciones= Devolucion::whereYear('created_at', substr($request->inicio,0,4))
            ->whereMonth('created_at','>=' ,substr( $request->inicio,5,2))
            ->whereMonth('created_at','<=', substr($request->fin,5,2))
            ->whereDay('created_at','>' , substr($request->inicio,8,2))
            ->whereDay('created_at','<=', substr($request->fin,8,2))
            ->get();
        $total=count($devoluciones);
            return response()->json(['data'=>$devoluciones, "recordsTotal"=>$total,"recordsFiltered"=>$total]);
    }
}
