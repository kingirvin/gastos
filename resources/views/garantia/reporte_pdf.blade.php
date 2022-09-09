<!doctype html>
<html>
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
        <div style="padding: 20px;width: 100%;float: left;">           
            <div  style="float: left;">           
                <img src="http://172.18.1.245:8080/img/fondo.jpeg" style="width: 100px;"> 
            </div>           
            <div style="float: left; padding-left: 20px;">           
                <h1>oficina sdkfskd dlfksdklfnkldfnsdklfnskdln sdkfnsd fdsfsd fsdjfkbsdf</h1> 
            </div>           
            <div  style="margin-right: 20px;float: right;">           
                <img src="http://172.18.1.245:8080/img/fondo.jpeg" style="width: 100px;"> 
            </div> 
        </div>
        <div style="padding-top: 20px;margin: 10px;float: left;width: 100%;">
            <table style="width: 100%;padding-top: 20px; padding: 0.5rem 0.5rem;width: 100%;margin: 0 auto;clear: both;border-collapse: separate;border-spacing: 0;">
                <thead style="background: #857f7f;">
                    <tr>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Fecha</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Exp. SIAF</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">O/C- O/S</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Proveedor</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Voucher</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Exp. SIAF</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Concepto de registro</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Monto</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Mes</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Recibo</th>
                    <th style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($garantias as $garantia)
                    <tr>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{substr($garantia->created_atd,0,4)}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->exp_siaf}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->oc_os}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->proveedor}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->voucher}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->siaf}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->registro}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->monto}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->mes}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->recibo}}</td>
                        <td style="border-bottom-width: 1px;padding: 0.5rem 0.5rem;border-style: solid;border-width: 0px 0px 1px 0px;">{{$garantia->estado=="1" ? 'Devuelto':'Ingreso'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    </body> 

</html>   