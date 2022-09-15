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
        <link href="{{public_path('libs/tabler/css/tabler.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{public_path('libs/tabler/css/tabler-flags.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{public_path('libs/tabler/css/tabler-payments.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{public_path('libs/tabler/css/tabler-vendors.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{public_path('css/admin.css')}}" rel="stylesheet" type="text/css">

    </head>
    <body >
        <div style="padding-top: 20px;margin: 10px;width: 100%;">
            <table style="width: 100%;padding-top: 20px; padding: 0.5rem 0.5rem;width: 100%;margin: 0 auto;clear: both;border-collapse: separate;border-spacing: 0;">                
                <thead>
                    <tr>
                        <td colspan="11"><img src="{{$logo}}" style="width: 100%;"></td>
                    </tr>
                    <tr>
                        <td colspan="11">
                            <h5>Usuario: {{Auth::user()->name." ".Auth::user()->apaterno." ".Auth::user()->amaterno}}</br>
                            {{$reporte}}</br>
                            Generado el {{$fecha}}
                            </h5> 
                        </td>                       
                    </tr>
                </thead>
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