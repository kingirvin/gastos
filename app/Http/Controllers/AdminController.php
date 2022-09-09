<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devolucion;
use App\Garantia;
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
            return view('garantia.reporte',compact('menu'));
        }
    }
    
    public function pdf($inicio,$fin){    
        $garantias= Garantia::whereYear('created_at', substr($inicio,0,4))
            ->whereMonth('created_at','>=' ,substr( $inicio,5,2))
            ->whereMonth('created_at','<=', substr($fin,5,2))
            ->whereDay('created_at','>' , substr($inicio,8,2))
            ->whereDay('created_at','<=', substr($fin,8,2))
            ->get();  
        /*$pdf = PDF::loadView('garantia.reporte_pdf',['garantias'=>$garantias]);
        $pdf->set_paper('letter', 'landscape');
        //$pdf .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
       // $pdf->loadHTML($pdf);
        return $pdf->stream();  */ 
        return view('garantia.reporte_pdf',compact('garantias'));
    } 
}
