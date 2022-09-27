<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tesoreria') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/libs/tabler/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/tabler/css/tabler-flags.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/tabler/css/tabler-payments.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/tabler/css/tabler-vendors.min.css') }}">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @yield('css') 

</head>
<body class="antialiased">
    <div class="wrapper">
        <header class="navbar navbar-expand-md navbar-dark d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <span>
                    <img src="/img/fondo.jpeg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                </span>
                </h1>
                <div class="navbar-nav flex-row order-md-last">   
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar">IC</span>
                    <div class="d-none d-xl-block ps-2 text-white">
                        <div>{{Auth::user()->name}} {{Auth::user()->apaterno}} {{Auth::user()->amaterno}}</div>
                        <div class="mt-1 small text-muted">
                            {{Auth::user()->oficina}}
                        </div>
                    </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{url('tienda/perfil')}}" class="dropdown-item">Mi perfil</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 6a7.75 7.75 0 1 0 10 0" /><line x1="12" y1="4" x2="12" y2="12" /></svg>
                            Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>  
                </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                    <ul class="navbar-nav">
                    

                    <!-- MODULO SELECCIONADO -->
                                        
                    </ul>
                </div>
                </div>
            </div>
        </header>
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                <div class="container-xl">
                    <ul class="navbar-nav">                                  
                    <!-- SUBMODULOS -->                                    
                        <!-- Tramite Documentario -->
                        @if(Auth::user()->tipo_id=="1")
                            <li class="nav-item ">
                                <a class="nav-link {{$menu=='Usuarios' ? 'text-green':''}} "  href="{{url('vista/usuarios')}}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="9" cy="7" r="4"></circle><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path><path d="M16 11h6m-3 -3v6"></path></svg>                                      
                                    </span>
                                    <span class="nav-link-title">Usuarios</span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->oficina=="Garantias" || Auth::user()->oficina=="Devoluciones" )
                        <li class="nav-item ">
                            <a class="nav-link {{$menu=='Garantia' ? 'text-green':''}}"href="{{url('vista/garantias')}}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"></path><line x1="13" y1="8" x2="15" y2="8"></line><line x1="13" y1="12" x2="15" y2="12"></line></svg>
                                </span>
                                <span class="nav-link-title">Garantias</span>
                            </a>
                        </li> 
                        <li class="nav-item ">
                            <a class="nav-link {{$menu=='forestal' ? 'text-green':''}}"href="{{url('vista/garantiasForestal')}}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"></path><line x1="13" y1="8" x2="15" y2="8"></line><line x1="13" y1="12" x2="15" y2="12"></line></svg>
                                </span>
                                <span class="nav-link-title">Garantias forestal</span>
                            </a>
                        </li> 
                        @endif
                        @if(Auth::user()->tipo_id=="1")
                            @if(Auth::user()->oficina=="Garantias" || Auth::user()->oficina=="Devoluciones" )
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='Reporte garantia' ? 'text-green':''}} "  href="{{url('vista/reporte/1')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Reporte Garantias</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='Reporte devolucion' ? 'text-green':''}} "  href="{{url('vista/reporte/2')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Reporte Devoluciones</span>
                                    </a>
                                </li>
                            @else                           
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='ro' ? 'text-green':''}}" style="padding-bottom: 0;text-align: center;"  href="{{url('vista/ro_comprobantes')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title"> Recursos Ordinarios</span>
                                    </a>
                                    <div class="{{$menu=='ro' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-018749</div>
                                </li>                           
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='rdr' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;" href="{{url('vista/rdr_comprobantes')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Recursos Directamente Recaudados</span>
                                    </a>
                                    <div class="{{$menu=='rdr' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-013003</div>
                                </li>                           
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='gar' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;"    href="{{url('vista/gar_comprobantes')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Garantias</span>
                                    </a>
                                    <div class="{{$menu=='gar' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-025400</div>
                                </li>                            
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='aprovechamiento' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;"    href="{{url('vista/aprovechamiento')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Aprovechamiento</span>
                                    </a>
                                    <div class="{{$menu=='aprovechamiento' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-028361</div>
                                </li>                            
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='donaciones' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;"    href="{{url('vista/donaciones')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Donaciones y Transferencias</span>
                                    </a>
                                    <div class="{{$menu=='donaciones' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-020980</div>
                                </li>  
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='Reporte comprobante' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;"    href="{{url('vista/comprobante/reporte')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Reportes</span>
                                    </a>
                                </li>                         
                            @endif
                        @elseif(Auth::user()->oficina=="Garantias")
                            <li class="nav-item ">
                                <a class="nav-link {{$menu=='Reporte garantia' ? 'text-green':''}} "  href="{{url('vista/reporte/1')}}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                    </span>
                                    <span class="nav-link-title">Reporte Garantias</span>
                                </a>
                            </li>
                        @elseif(Auth::user()->oficina=="Devoluciones")
                            <li class="nav-item ">
                                <a class="nav-link {{$menu=='Reporte devolucion' ? 'text-green':''}} "  href="{{url('vista/reporte/2')}}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                    </span>
                                    <span class="nav-link-title">Reporte devoluciones</span>
                                </a>
                            </li>
                            @else                           
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='ro' ? 'text-green':''}}" style="padding-bottom: 0;text-align: center;"  href="{{url('vista/ro_comprobantes')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title"> Recursos Ordinarios</span>
                                    </a>
                                    <div class="{{$menu=='ro' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-018749</div>
                                </li>                           
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='rdr' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;" href="{{url('vista/rdr_comprobantes')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Recursos Directamente Recaudados</span>
                                    </a>
                                    <div class="{{$menu=='rdr' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-013003</div>
                                </li>                           
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='gar' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;"    href="{{url('vista/gar_comprobantes')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Garantias</span>
                                    </a>
                                    <div class="{{$menu=='gar' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-025400</div>
                                </li>                            
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='aprovechamiento' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;"    href="{{url('vista/gar_comprobantes')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Aprovechamiento</span>
                                    </a>
                                    <div class="{{$menu=='aprovechamiento' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-028361</div>
                                </li>                            
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='donaciones' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;"    href="{{url('vista/gar_comprobantes')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Donaciones y Transferencias</span>
                                    </a>
                                    <div class="{{$menu=='donaciones' ? 'text-green':''}}" style="text-align: center;font-size: 12px;">0-201-020980</div>
                                </li>  
                                <li class="nav-item ">
                                    <a class="nav-link {{$menu=='Reporte comprobante' ? 'text-green':''}} "  style="padding-bottom: 0;text-align: center;"    href="{{url('vista/comprobante/reporte')}}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
                                        </span>
                                        <span class="nav-link-title">Reportes</span>
                                    </a>
                                </li>    
                        @endif                                       
                    </ul>
                </div>
                </div>
            </div>
        </div>
        <div class="page-wrapper position-relative">
            <div class="container-xl">
            <!-- Page title -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            GOBIERNO REGIONAL DE MADRE DE DIOS
                        </div>
                        <h2 class="page-title">
                            @yield('nombre') 
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row">   
                     @yield('content') 
                </div>
            </div>
        </div>
  
        <footer class="footer footer-transparent d-print-none">
            <div class="container">
            <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="#" class="link-secondary">Documentación</a></li>                
                    <li class="list-inline-item">                  
                    <a href="https://www.linkedin.com/in/jos%C3%A9-cortijo-bellido-49a513b5/" target="_blank" class="link-secondary" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 7l5 5l-5 5"></path><line x1="12" y1="19" x2="19" y2="19"></line></svg>
                        Developer
                    </a>
                    </li>
                </ul>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                    Copyright © 2022
                    <a href="https://www.gob.pe/regionmadrededios" class="link-secondary">Gobierno Regional de Madre de Dios</a>.                  
                    </li>
                </ul>
                </div>
            </div>
            </div>
        </footer>
        <!--<div id="cargando_pagina">
            <div class="text-center pt-4">
            <div class="spinner-border text-blue" role="status"></div> <b>Cargando...</b>
            </div>
        </div>-->
        </div>

    </div>
    <script src="{{ asset('/libs/jquery-3.4.1.min.js') }}"></script>  
    <script src="{{ asset('/libs/tabler/js/tabler.min.js') }}"></script>
    <script src="{{ asset('/libs/tabler/js/demo.min.js') }}"></script>
    <script src="{{ asset('/js/admin.js') }}"></script>
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    @yield('jss') 

</body>
</html>
