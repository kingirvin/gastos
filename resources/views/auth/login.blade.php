@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="text-center text-md-start mb-4">
                <img src="/img/fondo.jpeg" height="150" alt="">
            </div>
            <div>
                <div class="d-flex mb-3">
                  <h1 class="m-0">Plataforma de Garantias</h1>
                </div>
            </div>
            <p style="text-align: justify;">
            La de tesoreria del Gobierno Región de Madre de Dios proporciona a los funcionarios de la institución herramienta para el desempeño de sus funciones en el marco de la modernización y simplificación administrativa mediante el uso estratégico de las tecnologías digitales.
            </p>
        </div>
        <div class="col-md-5">
            <div class="card card-md">

                <div class="card-body">
                    <h2 class="card-title text-center mb-3 font-weight-bold">INICIAR DE SESIÓN</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correo') }}</label>

                            <div class="input-icon">
                                
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><polyline points="3 7 12 13 21 7"></polyline></svg>
                                </span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>

                            <div class="input-icon">                                    
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="5" y="11" width="14" height="10" rx="2"></rect><circle cx="12" cy="16" r="1"></circle><path d="M8 11v-4a4 4 0 0 1 8 0v4"></path></svg>
                                </span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                <span class="form-check-label">Recodarme en este dispositivo</span>
                            </label>
                        </div>
                        <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">INGRESAR</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvide mi contraseña') }}
                                    </a>
                                @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
