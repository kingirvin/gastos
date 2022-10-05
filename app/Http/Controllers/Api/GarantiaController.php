<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Devolucion;
use App\Garantia_forestal;
use App\Garantia;
use App\User;
use Auth;
use DataTables;

class GarantiaController extends Controller
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
        $lista=Garantia::with('devoluciones')->orderBy('id', 'DESC')->get();
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    { 
        //return $request;
        $estado="1";
        if(
            $request->exp_siaf==null||
            $request->oc_os==null||
            $request->proveedor==null||
            $request->voucher==null||
            $request->siaf==null||
            $request->registro==null||
            $request->monto==null||
            $request->mes==null||
            $request->recibo==null)
            $estado="3";
        $user=Auth::user();
        if($request->id != "0"){
            $garantia= Garantia::find($request->id);
            $garantia->exp_siaf=$request->exp_siaf;
            $garantia->oc_os=$request->oc_os;
            $garantia->proveedor=$request->proveedor;
            $garantia->voucher=$request->voucher;
            $garantia->siaf=$request->siaf;
            $garantia->registro=$request->registro;
            $garantia->monto=$request->monto;
            $garantia->mes=$request->mes;
            $garantia->recibo=$request->recibo;
            $garantia->estado=$estado;
            $garantia->user_id=$user->id;
        }
        else{
            $garantia=new Garantia;
            $garantia->exp_siaf=$request->exp_siaf;
            $garantia->oc_os=$request->oc_os;
            $garantia->proveedor=$request->proveedor;
            $garantia->voucher=$request->voucher;
            $garantia->siaf=$request->siaf;
            $garantia->registro=$request->registro;
            $garantia->monto=$request->monto;
            $garantia->mes=$request->mes;
            $garantia->recibo=$request->recibo;
            $garantia->estado=$estado;
            $garantia->user_id=$user->id;
        }
        if($garantia->save())
            return response()->json(['message'=>'Se guardo correctamente'], 200);
        else
            return response()->json(['message'=>'Error, no se guardaron los datos'], 500);

    }
    public function buscar(Request $request){
        return $garantia=Garantia::find($request->id);
    }
    public function listaIdNombre(Request $request){
        $garantia= Garantia::select('id','oc_os as text')->orderBy('id', 'DESC')->get();
        return response()->json([$garantia]);
    }
    public function reporteBuscar(Request $request){   
        if($request->id==1)  {   
            $garantias= Garantia::whereYear('created_at', substr($request->inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $request->inicio,5,2))
                ->whereMonth('created_at','<=', substr($request->fin,5,2))
                ->whereDay('created_at','>' , substr($request->inicio,8,2))
                ->whereDay('created_at','<=', substr($request->fin,8,2))
                ->orderBy('id', 'DESC')->get();
            $total=count($garantias);
        }
        else {   
            $garantias= Garantia_forestal::whereYear('created_at', substr($request->inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $request->inicio,5,2))
                ->whereMonth('created_at','<=', substr($request->fin,5,2))
                ->whereDay('created_at','>' , substr($request->inicio,8,2))
                ->whereDay('created_at','<=', substr($request->fin,8,2))
                ->orderBy('id', 'DESC')->get();
            $total=count($garantias);
        }
            return response()->json(['data'=>$garantias, "recordsTotal"=>$total,"recordsFiltered"=>$total]);
    }
}
