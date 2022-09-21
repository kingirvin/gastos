<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Giro;
use App\Conciliacion;
use App\User;
use Auth;
use DataTables;class UserController extends Controller
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
        $user=Auth::user()->oficina;
        if($user == "Comprobantes")
            $lista=User::where("oficina",$user)->orderBy('id', 'DESC')->get();
        else
            $lista=User::where("oficina","Devoluciones")->orwhere("oficina","Garantias")->orderBy('id', 'DESC')->get();
        return DataTables::of($lista)->ToJson();        
    }
    public function nuevo(Request $request) 
    { 
        //return $request;
        $user=Auth::user();
        if($request->id!=0){
            $gasto=User::find($request->id);
            $gasto->name=$request->name;
            $gasto->email=$request->email;
            $gasto->apaterno=$request->apaterno;
            $gasto->amaterno=$request->amaterno;
            $gasto->telefono=$request->telefono;
            $gasto->oficina=$request->oficina;
            $gasto->tipo_id=$request->tipo_id;
            $gasto->user_id=$user->id;
        }
        else{
           // $user=Auth::user();
            $gasto=new User;
            $gasto->name=$request->name;
            $gasto->email=$request->email;
            $gasto->password= Hash::make($request->password);
            $gasto->apaterno=$request->apaterno;
            $gasto->amaterno=$request->amaterno;
            $gasto->telefono=$request->telefono;
            $gasto->oficina=$request->oficina;
            $gasto->tipo_id=$request->tipo_id;
            $gasto->estado="1";
            $gasto->user_id=$user->id;
        }
        if($gasto->save())
            return response()->json(['message'=>'Se guardo correctamente'], 200);
        else
            return response()->json(['message'=>'Error, no se guardaron los datos'], 500);

    }
    public function estado(Request $request){
        $user=User::find($request->id);
        if ($user->estado==0) 
            $user->estado=1;    
        else              
            $user->estado=0;        
        if($user->save())
            return response()->json(['message'=>'Se guardo correctamente'], 200);
        else
            return response()->json(['message'=>'Error, no se guardaron los datos'], 500);

    }
    public function password(Request $request){
        $user=User::find($request->id);             
            $user->password= Hash::make($request->password);       
        if($user->save())
            return response()->json(['message'=>'Se guardo correctamente'], 200);
        else
            return response()->json(['message'=>'Error, no se guardaron los datos'], 500);

    }
    public function buscar(Request $request){
       return $user=User::find($request->id);
    }
}
