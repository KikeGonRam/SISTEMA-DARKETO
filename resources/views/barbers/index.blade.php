<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Lista de Barberos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Fondo claro */
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white; /* Fondo blanco para el contenedor */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra para el contenedor */
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .add-button {
            text-align: right;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; /* Fondo gris claro para encabezados */
        }
        img {
            border-radius: 4px; /* Bordes redondeados para imágenes */
        }
        .btn {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }
        .btn-warning {
            background-color: orange; /* Color para botón de editar */
        }
        .btn-danger {
            background-color: red; /* Color para botón de eliminar */
        }
        .btn-primary {
            background-color: blue; /* Color para botón de agregar */
        }
        .btn-secondary {
            background-color: grey; /* Color para botón de regresar */
        }
        .btn-green {
            background-color: #28a745; /* Color verde */
        }
        .btn-green:hover {
            background-color: #218838; /* Color verde más oscuro cuando el cursor pasa sobre el botón */
        }
    </style>
</head>
<body>
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1>Lista de Barberos</h1>
        <div class="add-button">
            <a href="{{ route('barbers.create') }}" class="btn btn-primary">Agregar Barbero</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Regresar</a> <!-- Botón de regresar -->
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if($barbers && $barbers->count() > 0)
                    @foreach ($barbers as $barber)
                        <tr>
                            <td>{{ $barber->id }}</td>
                            <td>{{ $barber->name }}</td>
                            <td>{{ $barber->email }}</td>
                            <td>
                                <img src="{{ $barber->photo ? asset('storage/' . $barber->photo) : asset('storage/barbers/barbero.avif') }}" alt="{{ $barber->name }}" width="100">
                            </td>
                            <td>
                                <a href="{{ route('barbers.edit', $barber->id) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ route('barbers.show', $barber->id) }}" class="btn btn-green">Detalles</a>
                                <form action="{{ route('barbers.destroy', $barber->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este barbero?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No hay barberos disponibles.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
