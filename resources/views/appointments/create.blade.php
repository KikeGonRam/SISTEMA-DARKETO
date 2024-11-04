<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Cita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Registrar Nueva Cita</h1>
        
        <!-- Formulario para registrar cita -->
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            
            <!-- Selección de usuario -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Seleccionar Usuario</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">Seleccione un usuario</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                    @endforeach
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
            
            <!-- Campo para fecha -->
            <div class="mb-3">
                <label for="date" class="form-label">Fecha de la Cita</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            
            <!-- Campo para hora -->
            <div class="mb-3">
                <label for="time" class="form-label">Hora de la Cita</label>
                <input type="time" name="time" id="time" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Registrar Cita</button>
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
