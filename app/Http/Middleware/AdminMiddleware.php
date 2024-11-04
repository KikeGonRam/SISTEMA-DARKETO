<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // Verifica si el usuario está autenticado y es un administrador
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Redirigir si no es administrador
        return redirect('/')->with('error', 'Acceso denegado.');
    }

    
}