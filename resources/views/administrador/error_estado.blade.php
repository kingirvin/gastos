<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta5
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Maintenance mode - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="{{asset('/libs/tabler/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('/libs/tabler/css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('/libs/tabler/css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('/libs/tabler/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('/libs/tabler/css/demo.min.css')}}" rel="stylesheet"/>
  </head>
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="empty">
          <div class="empty-img"><img src="{{url('/img/undraw_quitting_time_dm8t.svg')}}" height="128"  alt="">
          </div>
          <p class="empty-title">Error temporal</p>
          <p class="empty-subtitle text-muted">
            Lo sentimos, tu cuenta esta suspendida, contactese con el administrador para activar su cuenta
          </p>
          <div class="empty-action">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">
              <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="5" y1="12" x2="19" y2="12" /><line x1="5" y1="12" x2="11" y2="18" /><line x1="5" y1="12" x2="11" y2="6" /></svg>
              Regresar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
    <script src="./dist/js/demo.min.js"></script>
  </body>
</html>