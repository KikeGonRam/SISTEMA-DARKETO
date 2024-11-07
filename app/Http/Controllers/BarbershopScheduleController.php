<?php
namespace App\Http\Controllers;

use App\Models\BarbershopSchedule;
use Illuminate\Http\Request;

class BarbershopScheduleController extends Controller
{
    // Mostrar los horarios de la barbería
    public function index()
    {
        $schedules = BarbershopSchedule::all();
        return view('barbershop_schedules.index', compact('schedules'));
    }

    // Mostrar el formulario para crear un nuevo horario
    public function create()
    {
        return view('barbershop_schedules.create');
    }

    // Almacenar un nuevo horario
    public function store(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required|string',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
        ]);

        BarbershopSchedule::create([
            'day_of_week' => $request->day_of_week,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
        ]);

        return redirect()->route('barbershop_schedules.index')->with('success', 'Horario de la barbería creado con éxito.');
    }

    // Mostrar el formulario para editar un horario existente
    public function edit(BarbershopSchedule $barbershopSchedule)
    {
        return view('barbershop_schedules.edit', compact('barbershopSchedule'));
    }

    // Actualizar un horario
    public function update(Request $request, BarbershopSchedule $barbershopSchedule)
    {
        $request->validate([
            'day_of_week' => 'required|string',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
        ]);

        $barbershopSchedule->update([
            'day_of_week' => $request->day_of_week,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
        ]);

        return redirect()->route('barbershop_schedules.index')->with('success', 'Horario de la barbería actualizado con éxito.');
    }

    // Eliminar un horario
    public function destroy(BarbershopSchedule $barbershopSchedule)
    {
        $barbershopSchedule->delete();
        return redirect()->route('barbershop_schedules.index')->with('success', 'Horario de la barbería eliminado con éxito.');
    }
}