<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Barberos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">
    <div class="container my-5">
        <div class="text-center mb-4">
            <h1 class="display-4">Bienvenido al Panel de Barberos</h1>
            <p class="lead">Este es tu dashboard para gestionar citas.</p>
        </div>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tus Citas</h2>

                @if($appointments->isEmpty())
                    <p class="text-muted">No tienes citas programadas.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ $appointment->user->name ?? 'Cliente no disponible' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                        <td>{{ ucfirst($appointment->status) }}</td>
                                        <td>
                                            <!-- Formulario para actualizar el estado de la cita -->
                                            <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm" required>
                                                    <option value="aceptada" {{ $appointment->status === 'aceptada' ? 'selected' : '' }}>Aceptar</option>
                                                    <option value="cancelada" {{ $appointment->status === 'cancelada' ? 'selected' : '' }}>Cancelar</option>
                                                    <option value="pendiente" {{ $appointment->status === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm mt-2">Actualizar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
