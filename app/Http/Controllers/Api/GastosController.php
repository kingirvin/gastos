<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Gasto;
use App\Cuenta;
use App\User;
use DataTables;

class GastosController extends Controller
{
    //
    public function lista(Request $request)
    { 
        //3:ADMIN, 2:INSTITUCIONAL, 1:EMPRESA, 0:PUBLICO
        $lista=Gasto::get();
        return DataTables::of($lista)->ToJson();        
    }
}
