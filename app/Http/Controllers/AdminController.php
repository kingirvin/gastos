<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devolucion;
use App\Garantia;
use App\Proveedor;
use App\User;
use Auth; 
use PDF;
//use Barryvdh\DomPDF\Facade\Pdf;
class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');        
    }        
    public function usuario()
    {
        $user=Auth::user();
        $menu='Usuarios';
        return view('administrador.usuarios', compact('menu'));
    }       
    public function devolucion()
    {
        $devolucion=Devolucion::get();
        $menu='Devolucion';
        $garantias=garantia::select('id','oc_os as text')->get();
        return view('devolucion.devolucion',compact('menu','garantias'));
    } 
    public function reportepdf(){        
        return view('garantia.reporte_pdf');
    }      
    public function garantia()
    {
        $menu='Garantia';
        return view('garantia.garantia',compact('menu'));
    }
    public function error_estado(){
        return view('administrador.error_estado');
    }
    public function reporte($id){
        $hoy = date("Y-m-d");
        $year=date('Y');
        if($id==1){
            $menu='Reporte garantia';
            return view('garantia.reporte',compact('menu','hoy','year'));
        }
        else{
            $menu='Reporte devolucion';
            return view('devolucion.reporte',compact('menu','hoy','year'));
        }
    }
    
    public function pdf($inicio,$fin,$id){   
        $respuesta=null;
        $reporte="Reporte de devoluciones de ".$inicio. " al ". $fin;
        $fecha=date('Y-m-d');
        $path='img/logo_pdf.jpg';
        $type=pathinfo($path,PATHINFO_EXTENSION);
        $data=file_get_contents($path);
        $logo='data:image/'.$type.';base64,'.base64_encode($data);
        if ($id==1) {
            $respuesta= Garantia::whereYear('created_at', substr($inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $inicio,5,2))
                ->whereMonth('created_at','<=', substr($fin,5,2))
                ->whereDay('created_at','>' , substr($inicio,8,2))
                ->whereDay('created_at','<=', substr($fin,8,2))
                ->get();              
            $reporte="Reporte de garantias de ".$inicio. " al ". $fin;

            $pdf=app('dompdf.wrapper');
            $pdf->loadView('garantia.reporte_pdf',['garantias'=>$respuesta,"logo"=>$logo,'reporte'=>$reporte,'fecha'=>$fecha]);
            $pdf->set_paper('letter', 'landscape');
            //$pdf .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
        // $pdf->loadHTML($pdf);
            return $pdf->stream();  

        }
        else{            
             $respuesta= Devolucion::whereYear('created_at', substr($inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $inicio,5,2))
                ->whereMonth('created_at','<=', substr($fin,5,2))
                ->whereDay('created_at','>' , substr($inicio,8,2))
                ->whereDay('created_at','<=', substr($fin,8,2))
                ->get(); 
                $reporte="Reporte de devoluciones de ".$inicio. " al ". $fin;
        
                
                //in View<img src=" $data['logo'] " width="150" height="150"/>
                //return view('devolucion.reporte_pdf',compact('respuesta','logo','reporte','fecha'));
 
                $pdf=app('dompdf.wrapper');
                $pdf->loadView('devolucion.reporte_pdf',['devoluciones'=>$respuesta,"logo"=>$logo,'reporte'=>$reporte,'fecha'=>$fecha]);
                $pdf->set_paper('letter', 'landscape');
                //$pdf .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
               // $pdf->loadHTML($pdf);
                return $pdf->stream();                              
            }
    } 
    public function comprobantes(){        
        $menu='Comprobantes';
        $proveedores=Proveedor::get();
        return view('comprobante.comprobante',compact('menu','proveedores'));
    }
}
