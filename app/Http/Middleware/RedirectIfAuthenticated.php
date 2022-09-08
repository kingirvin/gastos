<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->tipo_id=="1")
                return redirect('/vista/usuarios');
            elseif (Auth::user()->oficina=="Giro") 
                return redirect('/vista/giro');            
            else
            return redirect('/vista/conciliacion'); 
                       
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
