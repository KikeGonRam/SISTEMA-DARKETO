<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;   // Asumiendo que los clientes son 'User'
use App\Models\Barber; 
use App\Models\Appointment;


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

    public function dashboard()
    {
        return view('admin.dashboard'); // O la vista que desees mostrar
    }

    // Mostrar el formulario para crear una nueva cita
    public function createAppointment()
    {
        // Obtener todos los clientes y barberos
        $users = User::all();  // Obtener todos los usuarios (clientes)
        $barbers = Barber::all();  // Obtener todos los barberos

        // Mostrar la vista con los datos necesarios
        return view('admin.appointments.create', compact('users', 'barbers'));
    }

    // Guardar la cita
    public function storeAppointment(Request $request)
    {
        // Validación de los datos enviados
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barber_id' => 'required|exists:barbers,id',
            'appointment_date' => 'required|date|after:today',
        ]);

        // Crear la cita
        Appointment::create([
            'user_id' => $request->user_id,
            'barber_id' => $request->barber_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',  // Estado inicial de la cita
        ]);

        // Redirigir al administrador con un mensaje de éxito
        return redirect()->route('admin.appointments.index')->with('success', 'Cita creada con éxito.');
    }
}