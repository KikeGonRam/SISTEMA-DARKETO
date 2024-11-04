<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarberAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('barber.login'); // Asegúrate de crear esta vista
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Verificar si el correo existe
        $barber = Barber::where('email', $request->email)->first();

        if (!$barber) {
            return redirect()->back()->withErrors(['email' => 'El correo electrónico no está registrado.']);
        }

        // Iniciar sesión con el guard de barberos
        Auth::guard('barber')->login($barber); // Cambiado para usar el guard de barberos

        return redirect()->route('barbers.dashboard');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('barbers.login');
    }
}
