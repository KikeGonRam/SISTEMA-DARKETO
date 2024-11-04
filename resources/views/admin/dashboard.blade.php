<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Panel de Administración</title>
    @vite('resources/css/admin.css') <!-- Carga de estilos -->
    <style>
        .logout {
            position: absolute;
            top: 20px; /* Ajusta según sea necesario */
            right: 20px; /* Ajusta según sea necesario */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Panel de Administración de DARKETO</h1>
        <!-- Opción para cerrar sesión en la esquina superior derecha -->
        <div class="logout">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="button">Cerrar Sesión</button>
            </form>
        </div>
    </div>
    
    <div class="container">
        <div class="card">
            <h2>Bienvenido al Panel de Administración</h2>
            <p>Utiliza las siguientes opciones para gestionar la barbería.</p>
            <div class="actions mb-3">
                <a href="{{ route('users.index') }}" class="button">Gestionar Usuarios</a>
                <a href="{{ route('appointments.index') }}" class="button">Gestionar Citas</a>
                <!-- Opción para crear barberos -->
                <a href="{{ route('barbers.index') }}" class="button">Gestionar Barbero</a>
            </div>
        </div>
    </div>
    
    @vite('resources/js/app.js') <!-- Carga de scripts -->
</body>
</html>
