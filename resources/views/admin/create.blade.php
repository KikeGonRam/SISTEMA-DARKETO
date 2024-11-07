<!-- resources/views/admin/appointments/create.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Crear Cita</h1>

        <!-- Mostrar errores si existen -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para crear cita -->
        <form action="{{ route('admin.appointments.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="user_id" class="block text-gray-700">Selecciona un Usuario:</label>
                <select name="user_id" id="user_id" class="form-select mt-1 block w-full" required>
                    <option value="">Seleccionar Usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="barber_id" class="block text-gray-700">Selecciona un Barbero:</label>
                <select name="barber_id" id="barber_id" class="form-select mt-1 block w-full" required>
                    <option value="">Seleccionar Barbero</option>
                    @foreach ($barbers as $barber)
                        <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="appointment_date" class="block text-gray-700">Fecha de la Cita:</label>
                <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-input mt-1 block w-full" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Cita</button>
        </form>
    </div>
@endsection
