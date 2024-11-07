<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Citas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <h1 class="text-center mb-4">Lista de Citas</h1>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('appointments.create') }}" class="btn btn-primary">Registrar Nueva Cita</a>
        </div>

        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Regresar</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Barbero</th>
                        <th>Fecha de la Cita</th>
                        <th>Hora de la Cita</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->user->name }}</td>
                            <td>
                                @if($appointment->barber && $appointment->barber->photo)
                                    <!-- Usamos asset() para generar la URL pública de la imagen -->
                                    {{ $appointment->barber->name }}
                                @else
                                    Sin barbero
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->translatedFormat('j \d\e F \d\e Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</td>
                            <td>
                                <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm">Detalles</a>
                                <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta cita?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
