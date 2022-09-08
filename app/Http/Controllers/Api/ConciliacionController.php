<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Giro;
use App\Conciliacion;
use App\User;
use Auth;
use DataTables;

class ConciliacionController extends Controller
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
        $lista=Conciliacion::get();
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    { 
        //return $request;
        $user=Auth::user();
        if($request->id != "0"){
            $conciliacion= Conciliacion::find($request->id);
            $conciliacion->exp_siaf=$request->exp_siaf;
            $conciliacion->oc_os=$request->oc_os;
            $conciliacion->proveedor=$request->proveedor;
            $conciliacion->voucher=$request->voucher;
            $conciliacion->siaf=$request->siaf;
            $conciliacion->registro=$request->registro;
            $conciliacion->monto=$request->monto;
            $conciliacion->mes=$request->mes;
            $conciliacion->recibo=$request->recibo;
            $conciliacion->estado="1";
            $conciliacion->user_id=$user->id;
        }
        else{
            $conciliacion=new Conciliacion;
            $conciliacion->exp_siaf=$request->exp_siaf;
            $conciliacion->oc_os=$request->oc_os;
            $conciliacion->proveedor=$request->proveedor;
            $conciliacion->voucher=$request->voucher;
            $conciliacion->siaf=$request->siaf;
            $conciliacion->registro=$request->registro;
            $conciliacion->monto=$request->monto;
            $conciliacion->mes=$request->mes;
            $conciliacion->recibo=$request->recibo;
            $conciliacion->estado="1";
            $conciliacion->user_id=$user->id;
        }
        if($conciliacion->save())
            return response()->json(['message'=>'Se guardo correctamente'], 200);
        else
            return response()->json(['message'=>'Error, no se guardaron los datos'], 500);

    }
    public function buscar(Request $request){
        return $conciliacion=Conciliacion::find($request->id);
    }
    public function listaIdNombre(Request $request){
        $consiliacion= Conciliacion::select('id','oc_os as text')->get();
        return response()->json([$consiliacion]);
    }
}
