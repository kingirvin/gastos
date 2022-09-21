<?php

namespace App\Http\Controllers\Api;

use App\Devolucion;
use App\Garantia;
use App\Rdr_comprobante;
use App\Proveedor;
use App\User;
use Auth;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RdrComprobanteController extends Controller
{
    // //
    public function __construct()
    {
        $this->middleware('auth');        
    }    
    public function listar() 
    { 
        //3:ADMIN, 2:INSTITUCIONAL, 1:EMPRESA, 0:PUBLICO
        $lista=Rdr_comprobante::with('proveedor','usuario')->orderBy('id', 'DESC')->get();
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    { 
        //return $request;
        $user=Auth::user();
        $comprobante=[];
        $estado=1;
        if(
            $request->siaf==null ||
            $request->documento_tipo==null ||
            $request->nro_doc==null ||
            $request->importe==null ||
            $request->proveedor_nombre==null)
            $estado=0;
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
            $comprobante=Rdr_comprobante::find($request->comprobante_id);            
            $comprobante->siaf=$request->siaf;
            $comprobante->documento_tipo=$request->documento_tipo;
            $comprobante->nro_doc=$request->nro_doc;
            $comprobante->importe=$request->importe;
            $comprobante->estado=$estado;
            $comprobante->user_id=$user->id;
            $comprobante->proveedor_id=$request->proveedor_id;
        }
        else{
            $comprobante=new Rdr_comprobante;   
            $comprobante->siaf=$request->siaf;
            $comprobante->documento_tipo=$request->documento_tipo;
            $comprobante->nro_doc=$request->nro_doc;
            $comprobante->importe=$request->importe;
            $comprobante->estado=$estado;
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
        return Rdr_comprobante::with('proveedor')->find($request->id);
    }
    public function eliminar(Request $request){        
        //return $request;
        $user=Auth::user();
        if($user->tipo_id == 1 && $user->oficina=="Comprobantes")
            return Rdr_comprobante::destroy($request->id);
        else{
            $comprobante= Rdr_comprobante::find($request->id);
            $comprobante->eliminar="1";
            return $comprobante->save();
        }
    }

}
