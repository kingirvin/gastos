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
                        <a href="http://172.17.1.250/cuenta" class="dropdown-item">Gestionar cuenta</a>
                        <div class="dropdown-divider"></div>
                        <a href="http://172.17.1.250/logout" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 6a7.75 7.75 0 1 0 10 0"></path><line x1="12" y1="4" x2="12" y2="12"></line></svg>
                        Salir
                        </a>
                        <form id="logout-form" action="http://172.17.1.250/logout" method="POST" style="display: none;">
                        <input type="hidden" name="_token" value="VfmLqnjcAxKQZm1j6vZUoRhlqE7FvXEICXipEoB8">                </form>
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
                    Copyright © 2021
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
    @yield('jss') 

</body>
</html>
