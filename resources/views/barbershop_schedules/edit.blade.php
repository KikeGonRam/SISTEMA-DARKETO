@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Editar Horario de la Barbería</h1>

        <form action="{{ route('barbershop_schedules.update', $barbershopSchedule->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="day_of_week" class="block text-sm font-semibold text-gray-700">Día de la Semana</label>
                <input type="text" name="day_of_week" id="day_of_week" class="mt-1 block w-full" value="{{ $barbershopSchedule->day_of_week }}" required>
            </div>

            <div class="mb-4">
                <label for="opening_time" class="block text-sm font-semibold text-gray-700">Hora de Apertura</label>
                <input type="time" name="opening_time" id="opening_time" class="mt-1 block w-full" value="{{ $barbershopSchedule->opening_time }}" required>
            </div>

            <div class="mb-4">
                <label for="closing_time" class="block text-sm font-semibold text-gray-700">Hora de Cierre</label>
                <input type="time" name="closing_time" id="closing_time" class="mt-1 block w-full" value="{{ $barbershopSchedule->closing_time }}" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Actualizar</button>
        </form>
    </div>
@endsection
