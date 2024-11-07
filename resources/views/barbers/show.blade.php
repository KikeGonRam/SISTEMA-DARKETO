<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Detalles del Barbero</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .barber-details {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .barber-details img {
            border-radius: 4px;
            width: 200px;
        }
        .btn {
            padding: 5px 10px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            background-color: grey;
        }
        .btn-secondary {
            background-color: grey;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles del Barbero</h1>
        <div class="barber-details">
            <img src="{{ $barber->photo ? asset('storage/' . $barber->photo) : asset('storage/barbers/barbero.avif') }}" alt="{{ $barber->name }}">
            <h2>{{ $barber->name }}</h2>
            <p><strong>Correo Electrónico:</strong> {{ $barber->email }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $barber->created_at->format('d/m/Y') }}</p>
        </div>

        <a href="{{ route('barbers.index') }}" class="btn btn-secondary">Regresar a la lista</a>
    </div>
</body>
</html>
