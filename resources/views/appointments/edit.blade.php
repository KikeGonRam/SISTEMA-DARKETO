<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Cita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <div class="card bg-light border-light">
            <div class="card-body">
                <h1 class="card-title text-center">Editar Cita</h1>
                <br>
                <form action="{{ route('appointments.update', $appointment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Campo para la fecha -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha de la Cita:</label>
                        <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('Y-m-d') }}" required>
                    </div>
                    
                    <!-- Campo para la hora -->
                    <div class="mb-3">
                        <label for="time" class="form-label">Hora de la Cita:</label>
                        <input type="time" name="time" class="form-control" value="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Seleccionar Usuario</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">Seleccione un usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $appointment->user_id ? 'selected' : '' }}>
                                    {{ $user->name }} - {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="barber_id" class="form-label">Seleccionar Barbero</label>
                        <select name="barber_id" id="barber_id" class="form-select" required>
                            <option value="">Seleccione un barbero</option>
                            @foreach($barbers as $barber)
                                <option value="{{ $barber->id }}" {{ $barber->id == $appointment->barber_id ? 'selected' : '' }}>
                                    {{ $barber->name }} - {{ $barber->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mb-2">Actualizar Cita</button>
                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary w-100">Regresar</a>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
