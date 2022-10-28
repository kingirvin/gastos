<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Garantia_forestal;
use App\Garantia;
use App\Tramite;
use App\Movimiento;
use App\User;
use Auth;
use DataTables;
class TramiteController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');        
    }    
    public function listar() 
    { 
        $user=Auth::user();
        //3:ADMIN, 2:INSTITUCIONAL, 1:EMPRESA, 0:PUBLICO
        $lista=tramite::with(['movimiento'=>function(Builder $query){
            $query->select('estado','origen,destino','id')->where('destino',$user->oficina);
        }])->orderBy('id', 'DESC')->get();
        foreach ($lista as $value) {
            if ($user->oficina=="Garantias") {
                return $temp=Garantia::find($value->garantia_id)->get();  
                $value->garantia=$temp;            
            } else {
                $temp=Garantia_forestal::find($value->garantia_id)->get();                         
                $value->garantia=$temp;            
            }
        }
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    { 
        $user=Auth::user();
        $tramite=Tramite::where('garantia_id',$request->id)->first();
        if($tramite==null){
            $tramite=new Tramite;
            $tramite->user_id=$user->id;
            $tramite->garantia_id=$request->id;
            $tramite->tabla=$user->oficina; 
            $tramite->save();
        } 
        $movimiento=new Movimiento;             
        $movimiento->origen=$user->oficina;
        $movimiento->destino=$request->destino;
        $movimiento->estado=0; //0:pendiente, 1:recepcionado , 2 Derivado
        $movimiento->user_id=$user->id; 
        $movimiento->tramite_id=$tramite->id;
        return $movimiento->save(); 
    }
}
