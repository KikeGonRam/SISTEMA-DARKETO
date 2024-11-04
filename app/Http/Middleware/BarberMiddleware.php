<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarberMiddleware
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado como barbero
        if (Auth::guard('barber')->check()) {
            return $next($request);
        }

        // Redirigir si no es barbero
        return redirect('/barber/login')->with('error', 'Acceso denegado.');
    }
}