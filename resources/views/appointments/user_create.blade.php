<!-- resources/views/appointments/user_create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Registrar Nueva Cita</h1>

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <!-- Selección de usuario -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Usuario</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <!-- Solo mostrar el usuario autenticado -->
                    <option value="{{ auth()->user()->id }}" selected>
                        {{ auth()->user()->name }} - {{ auth()->user()->email }}
                    </option>
                </select>
            </div>
            
            

            <!-- Selección de barbero -->
            <div class="mb-3">
                <label for="barber_id" class="form-label">Seleccionar Barbero</label>
                <select name="barber_id" id="barber_id" class="form-select" required>
                    <option value="">Seleccione un barbero</option>
                    @foreach($barbers as $barber)
                        <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Otros campos -->
            <div class="mb-3">
                <label for="date" class="form-label">Fecha</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Hora</label>
                <input type="time" name="time" id="time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Cita</button>
        </form>
    </div>
@endsection
