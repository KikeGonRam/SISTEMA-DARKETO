<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User; // Asegúrate de importar el modelo User
use App\Models\Barber; // Esta línea es crucial
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        // Obtener todas las citas
        $appointments = Appointment::all();
        return view('admin.index', compact('appointments'));
    }

    public function indexx()
{
    $appointments = Appointment::where('user_id', auth()->user()->id)->get();
    return view('user.appointments.index', compact('appointments'));
}


    public function create()
    {
        // Obtener todos los usuarios y barberos para pasarlos a la vista
        $users = User::all(); // Obtener todos los usuarios
        $barbers = Barber::all(); // Obtener todos los barberos

        // Pasar las variables a la vista
        return view('appointments.create', compact('users', 'barbers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barber_id' => 'required|exists:barbers,id', // Validar el barbero
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        // Combina la fecha y la hora
        $appointmentTime = $request->date . ' ' . $request->time;

        // Crear la cita
        Appointment::create([
            'user_id' => $request->user_id,
            'barber_id' => $request->barber_id, // Asegúrate de almacenar el barbero
            'appointment_time' => $appointmentTime,
        ]);

        // Redirigir a la lista de citas con un mensaje de éxito
        return redirect()->route('appointments.index')->with('success', 'Cita registrada con éxito.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $users = User::all();
        $barbers = Barber::all();

        return view('appointments.edit', compact('appointment', 'users', 'barbers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barber_id' => 'required|exists:barbers,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $appointment = Appointment::findOrFail($id);

        // Combina la fecha y la hora
        $appointmentTime = $request->date . ' ' . $request->time;
        $appointment->appointment_time = $appointmentTime;
        $appointment->user_id = $request->user_id;
        $appointment->barber_id = $request->barber_id;
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Cita eliminada correctamente.');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validar el nuevo estado
        $request->validate([
            'status' => 'required|in:aceptada,cancelada,pendiente',
        ]);

        // Buscar la cita y actualizar el estado
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->input('status');
        $appointment->save();

        // Redirigir de nuevo al panel de barberos con mensaje de éxito
        return redirect()->route('barbers.dashboard')->with('success', 'El estado de la cita ha sido actualizado.');
    }

    public function showAppointments()
    {
        // Obtén las citas del barbero autenticado
        $appointments = Appointment::where('barber_id', auth()->id())->get();

        // Asegúrate de pasar la variable a la vista
        return view('barbers.cita', compact('appointments'));
    }

    public function userCreate()
    {

        // Aquí obtienes todos los barberos y no los usuarios, ya que el usuario se asignará automáticamente
        $barbers = Barber::all(); // Obtener todos los barberos

        return view('appointments.user_create', compact( 'barbers')); // Pasamos solo los barberos a la vista
    }

    public function citas()
    {
        // Obtener las citas del usuario autenticado
        $appointments = Appointment::where('user_id', Auth::id())->get();

        return view('users.citas', compact('appointments'));
    }

    public function userstore(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);
    
        try {
            // Crear la cita
            Appointment::create([
                'user_id' => auth()->user()->id,  // El usuario autenticado
                'barber_id' => $validated['barber_id'],
                'date' => $validated['date'],
                'time' => $validated['time'],
            ]);
    
            // Redirigir al usuario común a su panel de citas
            return redirect()->route('users.citas')->with('success', 'Cita creada con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al crear la cita.');
        }
    }
    
}