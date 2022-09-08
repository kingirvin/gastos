<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Usuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=Auth::user();
        if ($user->oficina=="gastos") {
            return redirect("vista/gastos");
        }elseif ($use->oficina=="cuentas") {
            return redirect("vista/cuentas");
        }
        else{
            return redirect("vista/usuarios");
        }
        return $next($request);
    }
}
