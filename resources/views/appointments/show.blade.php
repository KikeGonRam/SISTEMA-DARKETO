<!-- resources/views/appointments/show.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de la Cita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <h1 class="text-center">Detalles de la Cita</h1>
        <div class="card bg-white border-light">
            <div class="card-body">
                <h5 class="card-title">Usuario</h5>
                <p class="card-text">{{ $appointment->user->name }} - {{ $appointment->user->email }}</p>

                <h5 class="card-title">Barbero</h5>
                <p class="card-text">{{ $appointment->barber->name }} - {{ $appointment->barber->email }}</p>
                
                <h5 class="card-title">Fecha de la Cita</h5>
                <p class="card-text">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d \d\e F \d\e Y') }}</p>
                
                <h5 class="card-title">Hora de la Cita</h5>
                <p class="card-text">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('appointments.index') }}" class="btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
