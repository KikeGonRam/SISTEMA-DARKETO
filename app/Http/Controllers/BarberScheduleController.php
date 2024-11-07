<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarberSchedule;
use App\Models\Barber;

class BarberScheduleController extends Controller
{
    // Mostrar una lista de horarios de barberos
    public function index()
    {
        $schedules = BarberSchedule::with('barber')->get();
        return view('barber_schedules.index', compact('schedules'));
    }

    // Mostrar el formulario para crear un nuevo horario
    public function create()
    {
        $barbers = Barber::all(); // Obtener todos los barberos para seleccionarlos en el formulario
        return view('barber_schedules.create', compact('barbers'));
    }

    // Guardar un nuevo horario en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        BarberSchedule::create($request->all());

        return redirect()->route('barber_schedules.index')->with('success', 'Horario creado exitosamente.');
    }

    // Mostrar el formulario para editar un horario
    public function edit($id)
    {
        $schedule = BarberSchedule::findOrFail($id);
        $barbers = Barber::all();
        return view('barber_schedules.edit', compact('schedule', 'barbers'));
    }

    // Actualizar un horario en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule = BarberSchedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('barber_schedules.index')->with('success', 'Horario actualizado exitosamente.');
    }

    // Eliminar un horario de la base de datos
    public function destroy($id)
    {
        $schedule = BarberSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('barber_schedules.index')->with('success', 'Horario eliminado exitosamente.');
    }
}