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
use stdClass;
class MovimientoControler extends Controller
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
        $lista=Movimiento::with('tramite')->where('destino',$user->oficina)->orderBy('id', 'DESC')->get();
        foreach ($lista as $value) {
            if ($value->tramite['tabla']=="Garantias") {
                $temp=Garantia::find($value->tramite['garantia_id']);  
                $value->tramite['garantia']=$temp;            
            } else {
                $temp=Garantia_forestal::find($value->tramite['garantia_id']);  
                $value->tramite['garantia']=$temp;            
            }
        }
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    {     
        $user=Auth::user();
        $movimiento=Movimiento::find($request->id);
        $movimiento->estado=2;
        $movimiento->save();
        $nuevoMovimiento=new Movimiento;             
        $nuevoMovimiento->origen=$user->oficina;
        $nuevoMovimiento->destino=$request->destino;
        $nuevoMovimiento->estado=0; //0:pendiente, 1:recepcionado , 2 Derivado
        $nuevoMovimiento->user_id=$user->id; 
        $nuevoMovimiento->tramite_id=$movimiento->tramite_id;
        $nuevoMovimiento->anterior=$request->id;
        $nuevoMovimiento->save();
    }
    public function recepcinar($id) //0:pendiente, 1:recepcionado , 2 Derivado ,3Terminado
    { 
        $user=Auth::user();
        $movimiento=Movimiento::find($id);
        $movimiento->estado=1;
        $movimiento->save();
        $ds=new stdClass();
    }   
    public function seguimiento($id){       
        $menu='garantiasDe';
        $tramite=Tramite::where("garantia_id",$id)->first();
        if($tramite== null)
            return "no se derivo a ninguna oficina";
        $primero=Movimiento::where('tramite_id',$tramite->id)->where('anterior')->first();
        $movimientos=Movimiento::where('tramite_id',$tramite->id)->get();
        $ordenado=$this->ordenar($movimientos,null);
        return response()->json(['primero'=>$primero,'ordenado'=>$ordenado]);
    }
    
    protected function ordenar($movimientos,$anterior){
        $resultado=collect();
        foreach ($movimientos as $movimiento) {            
            if($movimiento->anterior == $anterior)
            {
                $elemento = new stdClass();
                $elemento=$movimiento;
                $elemento->despues = $this->ordenar($movimientos, $movimiento->id);
                $resultado->push($elemento);
            }
        }
        $count=0;
        foreach ($resultado as $elemento) {
            $elemento->numero = $count;
            $elemento->total = count($resultado);
            $count++;
        }
        return $resultado;
    }
    
}
