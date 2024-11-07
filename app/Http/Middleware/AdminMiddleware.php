<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario autenticado es un administrador
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Si no es administrador, redirige a una ruta de acceso denegado o página de inicio
        return redirect()->route('home')->with('error', 'Acceso denegado.'); // O cualquier otra ruta que desees
    }

    
}   