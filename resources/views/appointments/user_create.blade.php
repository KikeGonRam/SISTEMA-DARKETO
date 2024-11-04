<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4">Crear Cita</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="user_id" class="block text-gray-700">Selecciona un Usuario:</label>
            <select name="user_id" id="user_id" class="form-select mt-1 block w-full" required>
                <option value="">Seleccionar Usuario</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label for="barber_id" class="block text-gray-700">Selecciona un Barbero:</label>
            <select name="barber_id" id="barber_id" class="form-select mt-1 block w-full" required>
                <option value="">Seleccionar Barbero</option>
                @foreach ($barbers as $barber)
                    <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="date" class="block text-gray-700">Fecha:</label>
            <input type="date" name="date" id="date" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="time" class="block text-gray-700">Hora:</label>
            <input type="time" name="time" id="time" class="form-input mt-1 block w-full" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Crear Cita</button>
    </form>
</div>
</body>
</html>