{{-- resources/views/barber_schedules/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-4">Editar Horario de Barbero</h1>

    <form action="{{ route('barber_schedules.update', $schedule->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Selección del barbero -->
        <div class="mb-4">
            <label for="barber_id" class="block text-sm font-medium text-gray-700">Seleccionar Barbero</label>
            <select name="barber_id" id="barber_id" class="mt-1 block w-full px-4 py-2 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Seleccione un barbero</option>
                @foreach ($barbers as $barber)
                    <option value="{{ $barber->id }}" {{ $schedule->barber_id == $barber->id ? 'selected' : '' }}>{{ $barber->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selección del día de la semana -->
        <div class="mb-4">
            <label for="day_of_week" class="block text-sm font-medium text-gray-700">Día de la Semana</label>
            <select name="day_of_week" id="day_of_week" class="mt-1 block w-full px-4 py-2 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Seleccione un día</option>
                <option value="Lunes" {{ $schedule->day_of_week == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                <option value="Martes" {{ $schedule->day_of_week == 'Martes' ? 'selected' : '' }}>Martes</option>
                <option value="Miércoles" {{ $schedule->day_of_week == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
                <option value="Jueves" {{ $schedule->day_of_week == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                <option value="Viernes" {{ $schedule->day_of_week == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                <option value="Sábado" {{ $schedule->day_of_week == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                <option value="Domingo" {{ $schedule->day_of_week == 'Domingo' ? 'selected' : '' }}>Domingo</option>
            </select>
        </div>

        <!-- Hora de inicio -->
        <div class="mb-4">
            <label for="start_time" class="block text-sm font-medium text-gray-700">Hora de Inicio</label>
            <input type="time" name="start_time" id="start_time" class="mt-1 block w-full px-4 py-2 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $schedule->start_time }}" required>
        </div>

        <!-- Hora de fin -->
        <div class="mb-4">
            <label for="end_time" class="block text-sm font-medium text-gray-700">Hora de Fin</label>
            <input type="time" name="end_time" id="end_time" class="mt-1 block w-full px-4 py-2 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $schedule->end_time }}" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">Actualizar Horario</button>
    </form>
</div>
@endsection
