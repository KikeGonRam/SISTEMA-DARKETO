<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis Citas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Mis Citas</h1>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('appointments.create') }}" class="btn btn-primary">Registrar Nueva Cita</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Barbero</th>
                        <th>Fecha de la Cita</th>
                        <th>Hora de la Cita</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>
                                @if($appointment->barbero && $appointment->barber->photo)
                                    <!-- Mostrar la foto del barbero -->
                                    <img src="{{ $appointment->barbero->photo }}" alt="{{ $appointment->barber->name }}" width="40" height="40" class="rounded-circle">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
