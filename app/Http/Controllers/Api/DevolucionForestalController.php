<?php

namespace App\Http\Controllers\Api;

use App\Garantia_forestal;
use App\Devolucion_forestal;
use App\User;
use Auth;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevolucionForestalController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');        
    }    
    public function listar() 
    { 
        //3:ADMIN, 2:INSTITUCIONAL, 1:EMPRESA, 0:PUBLICO
        $lista=Devolucion_forestal::orderBy('id', 'DESC')->get();
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    { 
        //return $request;
        $user=Auth::user();
        if($request->id!="0"){
            $devolucion=Devolucion_forestal::find($request->id);
            $devolucion->nro=$request->nro;
            $devolucion->reg_siaf=$request->siaf;
            $devolucion->periodo=$request->periodo;
            $devolucion->cheque=$request->cheque;
            $devolucion->monto=number_format($request->monto,2,'.',',');
            $devolucion->observacion=$request->observacion;
            $devolucion->user_id=$user->id;
            $devolucion->garantia_id=$request->garantia_id;
        }
        else{
            $devolucion=new Devolucion_forestal;
            $devolucion->nro=$request->nro;
            $devolucion->reg_siaf=$request->siaf;
            $devolucion->periodo=$request->periodo;
            $devolucion->cheque=$request->cheque;
            $devolucion->monto=number_format($request->monto,2,'.',',');
            $devolucion->observacion=$request->observacion;
            $devolucion->user_id=$user->id;
            $devolucion->estado="1";
            $devolucion->garantia_id=$request->garantia_id;

        }
        if($devolucion->save()){
            $garantia=Garantia_forestal::find($request->garantia_id);
            $garantia->estado ="0";
            $garantia->save();
            return response()->json(['message'=>'Se guardo correctamente'], 200);            
        }
        else
            return response()->json(['message'=>'Error, no se guardaron los datos'], 500);

    }
    public function buscar(Request $request){
        //return $request;
        return Devolucion_forestal::find($request->id);
    }
    public function reporteBuscar(Request $request){
              
        $devoluciones= Devolucion_forestal::whereYear('created_at', substr($request->inicio,0,4))
            ->whereMonth('created_at','>=' ,substr( $request->inicio,5,2))
            ->whereMonth('created_at','<=', substr($request->fin,5,2))
            ->whereDay('created_at','>' , substr($request->inicio,8,2))
            ->whereDay('created_at','<=', substr($request->fin,8,2))
            ->orderBy('id', 'DESC')->get();
        $total=count($devoluciones);
            return response()->json(['data'=>$devoluciones, "recordsTotal"=>$total,"recordsFiltered"=>$total]);
    }
}
