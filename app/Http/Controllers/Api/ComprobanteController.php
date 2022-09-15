<?php

namespace App\Http\Controllers\Api;

use App\Devolucion;
use App\Garantia;
use App\Comprobante;
use App\Proveedor;
use App\User;
use Auth;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComprobanteController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');        
    }    
    public function listar() 
    { 
        //3:ADMIN, 2:INSTITUCIONAL, 1:EMPRESA, 0:PUBLICO
        $lista=Comprobante::with('proveedor')->get();
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    { 
        //return $request;
        $user=Auth::user();
        $comprobante=[];
        if($request->proveedor_id=="0"){
            $proveedor= new Proveedor;
            $proveedor->nombre=$request->proveedor_nombre;
            $proveedor->ruc=$request->ruc;
            $proveedor->estado="1";
            $proveedor->user_id=$user->id;
            $proveedor->save();
            $request->proveedor_id=$proveedor->id;
        }
        if($request->comprobante_id!="0"){
            $comprobante=Comprobante::find($request->comprobante_id);            
            $comprobante->siaf=$request->siaf;
            $comprobante->documento_tipo=$request->documento_tipo;
            $comprobante->nro_doc=$request->nro_doc;
            $comprobante->importe=$request->importe;
            $comprobante->estado="1";
            $comprobante->user_id=$user->id;
            $comprobante->proveedor_id=$request->proveedor_id;
        }
        else{
            $comprobante=new Comprobante;   
            $comprobante->siaf=$request->siaf;
            $comprobante->documento_tipo=$request->documento_tipo;
            $comprobante->nro_doc=$request->nro_doc;
            $comprobante->importe=$request->importe;
            $comprobante->estado="1";
            $comprobante->user_id=$user->id;
            $comprobante->proveedor_id=$request->proveedor_id;
        }
        if($comprobante->save()){
            return response()->json(['message'=>'Se guardo correctamente'], 200);            
        }
        else
            return response()->json(['message'=>'Error, no se guardaron los datos'], 500);

    }
    public function buscar(Request $request){
        //return $request;
        return Comprobante::with('proveedor')->find($request->id);
    }
    public function eliminar(Request $request){
        //return $request;
        return Comprobante::destroy($request->id);
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
