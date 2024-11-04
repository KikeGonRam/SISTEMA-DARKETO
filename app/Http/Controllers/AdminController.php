<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Verifica si el usuario es admin
        if (Auth::user() && Auth::user()->is_admin) {
            return view('admin.dashboard'); // Devuelve la vista del panel de administración
        }

        return redirect('/')->with('error', 'Acceso denegado.'); // Redirige si no es administrador
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard'); // O donde quieras redirigir a un usuario normal
    }
}
