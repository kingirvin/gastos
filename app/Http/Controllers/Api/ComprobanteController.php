<?php

namespace App\Http\Controllers\Api;

use App\Devolucion;
use App\Garantia;
use App\Ro_comprobante;
use App\Rdr_comprobante;
use App\Gar_comprobante;
use App\Aprovechamiento;
use App\Donacion;
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
        if($request->comprobante==1){
            $comprobantes= Ro_comprobante::with('proveedor','usuario')->whereYear('created_at', substr($request->inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $request->inicio,5,2))
                ->whereMonth('created_at','<=', substr($request->fin,5,2))
                ->whereDay('created_at','>' , substr($request->inicio,8,2))
                ->whereDay('created_at','<=', substr($request->fin,8,2))
                ->get();
            $total=count($comprobantes);
                return response()->json(['data'=>$comprobantes, "recordsTotal"=>$total,"recordsFiltered"=>$total]);
        }
        elseif ($request->comprobante==2) {
            $comprobantes= Rdr_comprobante::with('proveedor','usuario')->whereYear('created_at', substr($request->inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $request->inicio,5,2))
                ->whereMonth('created_at','<=', substr($request->fin,5,2))
                ->whereDay('created_at','>' , substr($request->inicio,8,2))
                ->whereDay('created_at','<=', substr($request->fin,8,2))
                ->get();
            $total=count($comprobantes);
                return response()->json(['data'=>$comprobantes, "recordsTotal"=>$total,"recordsFiltered"=>$total]);
        } 
        elseif ($request->comprobante==4) {
            $comprobantes= Aprovechamiento::with('proveedor','usuario')->whereYear('created_at', substr($request->inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $request->inicio,5,2))
                ->whereMonth('created_at','<=', substr($request->fin,5,2))
                ->whereDay('created_at','>' , substr($request->inicio,8,2))
                ->whereDay('created_at','<=', substr($request->fin,8,2))
                ->get();
            $total=count($comprobantes);
                return response()->json(['data'=>$comprobantes, "recordsTotal"=>$total,"recordsFiltered"=>$total]);
        } 
        elseif ($request->comprobante==5) {
            $comprobantes= Donacion::with('proveedor','usuario')->whereYear('created_at', substr($request->inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $request->inicio,5,2))
                ->whereMonth('created_at','<=', substr($request->fin,5,2))
                ->whereDay('created_at','>' , substr($request->inicio,8,2))
                ->whereDay('created_at','<=', substr($request->fin,8,2))
                ->get();
            $total=count($comprobantes);
                return response()->json(['data'=>$comprobantes, "recordsTotal"=>$total,"recordsFiltered"=>$total]);
        } 
        else {
            $comprobantes= Gar_comprobante::with('proveedor','usuario')->whereYear('created_at', substr($request->inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $request->inicio,5,2))
                ->whereMonth('created_at','<=', substr($request->fin,5,2))
                ->whereDay('created_at','>' , substr($request->inicio,8,2))
                ->whereDay('created_at','<=', substr($request->fin,8,2))
                ->get();
            $total=count($comprobantes);
                return response()->json(['data'=>$comprobantes, "recordsTotal"=>$total,"recordsFiltered"=>$total]);
        }
    }
    public function pdf($inicio,$fin,$id){   
        $respuesta=null;
        $reporte="Reporte de devoluciones de ".$inicio. " al ". $fin;
        $fecha=date('Y-m-d');
        $path='img/logo1.jpg';
        $type=pathinfo($path,PATHINFO_EXTENSION);
        $data=file_get_contents($path);
        $logo1='data:image/'.$type.';base64,'.base64_encode($data);
        $path='img/logo2.jpg';
        $type=pathinfo($path,PATHINFO_EXTENSION);
        $data=file_get_contents($path);
        $logo2='data:image/'.$type.';base64,'.base64_encode($data);
        if ($id==1) {
            $comprobantes = Ro_comprobante::whereYear('created_at', substr($inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $inicio,5,2))
                ->whereMonth('created_at','<=', substr($fin,5,2))
                ->whereDay('created_at','>' , substr($inicio,8,2))
                ->whereDay('created_at','<=', substr($fin,8,2))
                ->get();              
            $reporte="Reporte de Recursos Ordinarios de ".$inicio. " al ". $fin;
            $nro="0-201-018749";
           //return view('comprobante.reporte_pdf',compact('comprobantes','logo1','logo2','reporte','fecha','fecha',"nro"));

            $pdf=app('dompdf.wrapper');
            $pdf->loadView('comprobante.reporte_pdf',['comprobantes'=>$respuesta,"logo1"=>$logo1,"logo2"=>$logo2,'reporte'=>$reporte,'fecha'=>$fecha,"nro"=>$nro]);
            $pdf->set_paper('letter', 'landscape');
            //$pdf .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
        // $pdf->loadHTML($pdf);
            return $pdf->stream();  

        }
        elseif($id==2){            
             $respuesta= Rdr_comprobante::whereYear('created_at', substr($inicio,0,4))
                ->whereMonth('created_at','>=' ,substr( $inicio,5,2))
                ->whereMonth('created_at','<=', substr($fin,5,2))
                ->whereDay('created_at','>' , substr($inicio,8,2))
                ->whereDay('created_at','<=', substr($fin,8,2))
                ->get(); 
                $reporte="Reporte de  Recursos Directamente Recaudados de ".$inicio. " al ". $fin;
                $nro="0-201-013003";
        
                
                //in View<img src=" $data['logo'] " width="150" height="150"/>
                //return view('comprobante.reporte_pdf',compact('respuesta','logo','reporte','fecha'));
 
                $pdf=app('dompdf.wrapper');
                $pdf->loadView('comprobante.reporte_pdf',['comprobantes'=>$respuesta,"logo1"=>$logo1,"logo2"=>$logo2,'reporte'=>$reporte,'fecha'=>$fecha,"nro"=>$nro]);
                $pdf->set_paper('letter', 'landscape');
                //$pdf .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
               // $pdf->loadHTML($pdf);
                return $pdf->stream();                              
            }
            elseif ($id==4) {
                $respuesta= Aprovechamiento::whereYear('created_at', substr($inicio,0,4))
                   ->whereMonth('created_at','>=' ,substr( $inicio,5,2))
                   ->whereMonth('created_at','<=', substr($fin,5,2))
                   ->whereDay('created_at','>' , substr($inicio,8,2))
                   ->whereDay('created_at','<=', substr($fin,8,2))
                   ->get(); 
                   $reporte="Reporte de Aprovechamiento de ".$inicio. " al ". $fin;
                   $nro="0-201-028361";
           
                   
                   //in View<img src=" $data['logo'] " width="150" height="150"/>
                   //return view('comprobante.reporte_pdf',compact('respuesta','logo','reporte','fecha'));
    
                   $pdf=app('dompdf.wrapper');
                   $pdf->loadView('comprobante.reporte_pdf',['comprobantes'=>$respuesta,"logo1"=>$logo1,"logo2"=>$logo2,'reporte'=>$reporte,'fecha'=>$fecha,"nro"=>$nro]);
                   $pdf->set_paper('letter', 'landscape');
                   //$pdf .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
                  // $pdf->loadHTML($pdf);
                   return $pdf->stream(); 
            } 
            elseif ($id==5) {
                $respuesta= Donacion::whereYear('created_at', substr($inicio,0,4))
                   ->whereMonth('created_at','>=' ,substr( $inicio,5,2))
                   ->whereMonth('created_at','<=', substr($fin,5,2))
                   ->whereDay('created_at','>' , substr($inicio,8,2))
                   ->whereDay('created_at','<=', substr($fin,8,2))
                   ->get(); 
                   $reporte="Reporte de Donaciones y Transferencias de ".$inicio. " al ". $fin;
                   $nro="0-201-020980";
           
                   
                   //in View<img src=" $data['logo'] " width="150" height="150"/>
                   //return view('comprobante.reporte_pdf',compact('respuesta','logo','reporte','fecha'));
    
                   $pdf=app('dompdf.wrapper');
                   $pdf->loadView('comprobante.reporte_pdf',['comprobantes'=>$respuesta,"logo1"=>$logo1,"logo2"=>$logo2,'reporte'=>$reporte,'fecha'=>$fecha,"nro"=>$nro]);
                   $pdf->set_paper('letter', 'landscape');
                   //$pdf .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
                  // $pdf->loadHTML($pdf);
                   return $pdf->stream(); 
            } 
        else{    
                $respuesta= Gar_comprobante::whereYear('created_at', substr($inicio,0,4))
                   ->whereMonth('created_at','>=' ,substr( $inicio,5,2))
                   ->whereMonth('created_at','<=', substr($fin,5,2))
                   ->whereDay('created_at','>' , substr($inicio,8,2))
                   ->whereDay('created_at','<=', substr($fin,8,2))
                   ->get(); 
                   $reporte="Reporte de comprogantes de garantias de ".$inicio. " al ". $fin;
                   $nro="0-201-025400";                              
                   //in View<img src=" $data['logo'] " width="150" height="150"/>
                   //return view('comprobante.reporte_pdf',compact('respuesta','logo','reporte','fecha'));
    
                   $pdf=app('dompdf.wrapper');
                   $pdf->loadView('comprobante.reporte_pdf',['comprobantes'=>$respuesta,"logo1"=>$logo1,"logo2"=>$logo2,'reporte'=>$reporte,'fecha'=>$fecha,"nro"=>$nro]);
                   $pdf->set_paper('letter', 'landscape');
                   //$pdf .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
                  // $pdf->loadHTML($pdf);
                   return $pdf->stream();  
            }
    } 
}
