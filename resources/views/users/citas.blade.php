@extends('layouts.app') 

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4">Mis Citas</h1>

    <!-- Botón para crear una nueva cita -->
    <div class="mb-4">
        <a href="{{ route('appointments.user_create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Crear Cita</a>
    </div>

    @if ($appointments->isEmpty())
        <div class="bg-yellow-300 text-black p-2 rounded mb-4">
            No tienes citas programadas.
        </div>
    @else
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Barbero</th>
                    <th class="py-2 px-4 border-b">Fecha y Hora</th>
                    <th class="py-2 px-4 border-b">Estado</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $appointment->barber->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $appointment->appointment_time }}</td>
                        <td class="py-2 px-4 border-b">{{ $appointment->status }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('appointments.show', $appointment->id) }}" class="text-blue-500">Ver</a>
                            <!-- Puedes añadir más acciones como editar o cancelar aquí -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
