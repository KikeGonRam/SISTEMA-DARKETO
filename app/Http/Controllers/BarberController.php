<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BarberController extends Controller
{
    // Método para mostrar la lista de barberos
    public function index()
    {
        $barbers = Barber::all(); // Obtiene todos los barberos
        return view('barbers.index', compact('barbers')); // Asegúrate de tener una vista 'index.blade.php' en la carpeta 'resources/views/barbers'
    }

    // Método para mostrar el formulario de creación de un nuevo barbero
    public function create()
    {
        return view('barbers.create'); // Asegúrate de tener una vista 'create.blade.php'
    }

    // Método para almacenar un nuevo barbero
    // Método para almacenar un nuevo barbero
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:barbers', // Validación para el correo electrónico
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barber = new Barber();
        $barber->name = $request->name;
        $barber->email = $request->email; // Asignar el correo electrónico

        // Manejar la carga de la foto
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('barbers', 'public');
            $barber->photo = $path;
        }

        $barber->save();

        return redirect()->route('barbers.index')->with('success', 'Barbero agregado exitosamente.');
    }

    // Método para mostrar el formulario de edición de un barbero
    public function edit($id)
    {
        // Encuentra el barbero por ID
        $barber = Barber::findOrFail($id);

        // Retorna la vista de edición pasando el barbero encontrado
        return view('barbers.edit', compact('barber'));
    }


    // Método para actualizar un barbero
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:barbers,email,' . $id, // Asegúrate de que sea único, excluyendo el ID actual
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barber = Barber::findOrFail($id);
        $barber->name = $request->name;
        $barber->email = $request->email; // Actualizar el correo electrónico

        // Manejar la carga de la foto
        if ($request->hasFile('photo')) {
            // Eliminar la foto anterior si existe
            if ($barber->photo) {
                Storage::disk('public')->delete($barber->photo);
            }
            $path = $request->file('photo')->store('barbers', 'public');
            $barber->photo = $path;
        } else {
            // Si no se proporciona una nueva foto, mantén la existente
            // O establece una foto predeterminada
            if (empty($barber->photo)) {
                $barber->photo = 'barbers/barbero.jpg'; // Cambia esto por la ruta de tu foto predeterminada
            }
        }

        $barber->save();

        return redirect()->route('barbers.index')->with('success', 'Barbero actualizado exitosamente.');
    }

    public function destroy($id)
    {
        // Buscar el barbero por su ID
        $barber = Barber::findOrFail($id);

        // Eliminar la foto del almacenamiento si existe
        if ($barber->photo) {
            Storage::disk('public')->delete($barber->photo);
        }

        // Eliminar el barbero de la base de datos
        $barber->delete();

        // Redirigir a la lista de barberos con un mensaje de éxito
        return redirect()->route('barbers.index')->with('success', 'Barbero eliminado exitosamente.');
    }

    // Este método muestra el dashboard para el barbero
    // Método para el dashboard
    public function dashboard()
    {
        // Obtener citas del barbero autenticado
        $appointments = Appointment::where('barber_id', auth()->user()->id)->get();

        return view('barbers.dashboard', compact('appointments'));
    }

    // En app/Http/Controllers/BarberController.php
    public function profile()
    {
        return view('barbers.profile'); // Asegúrate de que exista esta vista
    }


    // Ejemplo en BarberController
public function showAppointments()
{
    // Obtén las citas del barbero autenticado (asumiendo que tienes un middleware de autenticación)
    $appointments = Appointment::where('barber_id', auth()->id())->get();

    // Envía $appointments a la vista
    return view('barbers.cita', compact('appointments'));
}



    // Otros métodos (edit, update, destroy)...
}