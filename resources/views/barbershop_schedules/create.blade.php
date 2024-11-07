<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Horario</title>

    <!-- Enlaza el archivo CSS compilado -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-3xl font-semibold text-center text-blue-700 mb-6">Agregar Horario de la Barbería</h1>

        <form action="{{ route('barbershop_schedules.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf

            <div class="mb-4">
                <label for="day_of_week" class="block text-sm font-semibold text-gray-700">Día de la Semana</label>
                <select name="day_of_week" id="day_of_week" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-md" required>
                    <option value="" disabled selected>Selecciona un día</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miércoles">Miércoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="opening_time" class="block text-sm font-semibold text-gray-700">Hora de Apertura</label>
                <input type="time" name="opening_time" id="opening_time" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="closing_time" class="block text-sm font-semibold text-gray-700">Hora de Cierre</label>
                <input type="time" name="closing_time" id="closing_time" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-md" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200">Guardar</button>
        </form>
    </div>
</body>
</html>
