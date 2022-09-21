<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- Scripts -->

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->

    </head>
    <body >
        <style>
            
            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1.5cm;
                margin:0cm;
                padding: 0cm;
                /** Estilos extra personales **/
               
                color: black;
                text-align: center;
                
            }
            .img{
                height: 1.5cm;
                margin:0px;               
            }
            .img-left{
               
            }
            .lado{
                width:20%;
                float:left;
            }
            .centro{
                width:60%;
                float:left;
            }
            h5{
                margin-top:5px;
            }
            .texto{
                margin-top: 2.5cm;
                width:100%
            }

        </style>
        <header>
            <div class="lado">
                <img  class="img img-left" src="{{$logo1}}">
            </div>
            <div class="centro">
                <p style="margin: 0; font-size: 10px;">“AÑO DEL FORTALECIMIENTO DE LA SOBERANÍA NACIONAL”</p>
                <p style="margin: 0; font-size: 16px;">Gobierno Regional de Madre de Dios</p>
                <p  style="margin: 0;font-size: 12px;">Oficina Regional de Administración</p>
                <p  style="margin: 0;font-size: 12px;">Oficina de Tesorería</p>
            </div>
            <div class="lado">
                <img  class="img img-left" src="{{$logo2}}">
            </div>
        </header>
        <div style="padding-top: 0px;margin: 10px;width: 100%;">
            <div class="texto">            
                <h5>Usuario: {{Auth::user()->name." ".Auth::user()->apaterno." ".Auth::user()->amaterno}}</br>
                    {{$reporte}}</br>
                    Generado el {{$fecha}}
                </h5> 
            </div>
            <table style="width: 100%;width: 100%;clear: both;border-collapse: separate;border-spacing: 0;">                               
                <thead style="background: #857f7f;">
                    <tr>                        
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Fecha</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Exp. SIAF</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">O/C- O/S</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Proveedor</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Voucher</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Exp. SIAF</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Concepto de registro</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Monto</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Mes</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Recibo</th>
                        <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;font-size: 12px;">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($garantias as $garantia)
                    <tr>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{substr($garantia->created_at,0,10)}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->exp_siaf}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->oc_os}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->proveedor}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->voucher}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->siaf}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->registro}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->monto}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->mes}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->recibo}}</td>
                        <td style="font-size: 12px;border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->estado=="1" ? 'Devuelto':'Ingreso'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    </body> 

</html>   