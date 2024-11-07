<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbería DARKETO - Horarios</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilos base */
        body {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            min-height: 100vh;
            background-color: black;
            font-family: Arial, sans-serif;
            overflow: hidden;
            color: white;
        }

        /* Header y navegación */
        .header {
            position: fixed;
            top: 0;
            right: 0;
            padding: 1rem;
            z-index: 3;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin-left: 1.5rem;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .header a:hover {
            color: #cccccc;
        }

        /* Contenedor principal */
        .container {
            position: relative;
            text-align: center;
            z-index: 2;
            padding: 2rem;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            font-size: 2.5em;
            color: #ffffff;
            margin-bottom: 1.5em;
            text-transform: uppercase;
        }

        .text-right {
            text-align: right;
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 20px;
            font-size: 1em;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border: none;
        }

        .btn-add:hover {
            background-color: #218838;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border: none;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Tabla transparente */
        .table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(0, 0, 0, 0.5); /* Fondo transparente oscuro */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .table th, .table td {
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2); /* Bordes sutiles */
            text-align: center;
        }

        .table th {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Animación de fondo */
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            background: radial-gradient(
                circle at center,
                rgba(0, 0, 0, 0) 10%,
                rgba(0, 0, 0, 0.9) 90%
            );
        }

        /* Partículas */
        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: red;
            border-radius: 50%;
            animation: floatParticles 8s linear infinite;
            box-shadow: 0 0 15px #ff0000,
                        0 0 30px #ff0000,
                        0 0 45px #ff4d4d;
            opacity: 0.75;
        }

        .particle:nth-child(2n) {
            background-color: white;
            width: 6px;
            height: 6px;
            animation-duration: 6s;
            box-shadow: 0 0 15px #ffffff,
                        0 0 25px #cccccc,
                        0 0 35px #ffffff;
        }

        .particle:nth-child(3n) {
            background-color: blue;
            width: 10px;
            height: 10px;
            animation-duration: 10s;
            box-shadow: 0 0 15px #0000ff,
                        0 0 30px #4d4dff,
                        0 0 45px #0000ff;
        }

        .particle:nth-child(4n) {
            width: 12px;
            height: 12px;
            animation-duration: 12s;
            opacity: 0.6;
            box-shadow: 0 0 20px #ff4d4d,
                        0 0 40px #ff4d4d,
                        0 0 60px #ff0000;
        }

        @keyframes floatParticles {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0.6;
            }
            50% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="background-animation"></div>

    <!-- Header -->
    <div class="header">
        <a href="{{ route('barber_schedules.index')}}">Horario de los Barberos</a>
    </div>

    <!-- Contenido de la página -->
    <div class="container">
        <h1>Horarios de la Barbería</h1>

        <!-- Botón Agregar -->
        <div class="text-right mb-6">
            <a href="{{ route('barbershop_schedules.create') }}" class="btn btn-add">Agregar Horario</a>
        </div>

        <!-- Tabla de horarios -->
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Hora de Apertura</th>
                        <th>Hora de Cierre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr class="hover:bg-gray-100">
                            <td>{{ $schedule->day_of_week }}</td>
                            <td>{{ $schedule->opening_time }}</td>
                            <td>{{ $schedule->closing_time }}</td>
                            <td>
                                <!-- Editar -->
                                <a href="{{ route('barbershop_schedules.edit', $schedule->id) }}" class="btn btn-edit">Editar</a>

                                <!-- Eliminar -->
                                <form action="{{ route('barbershop_schedules.destroy', $schedule->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Generar partículas de fondo
        document.addEventListener("DOMContentLoaded", () => {
            const backgroundAnimation = document.querySelector(".background-animation");
            const numParticles = 50; // Ajusta el número de partículas

            for (let i = 0; i < numParticles; i++) {
                const particle = document.createElement("div");
                particle.classList.add("particle");
                
                // Posición inicial aleatoria
                particle.style.left = `${Math.random() * 100}vw`;
                particle.style.top = `${Math.random() * 100}vh`;
                
                // Tamaño aleatorio de las partículas
                const size = Math.random() * 8 + 4; // Tamaño entre 4px y 12px
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Duración de animación aleatoria
                particle.style.animationDuration = `${Math.random() * 8 + 5}s`;
                
                backgroundAnimation.appendChild(particle);
            }
        });
    </script>
</body>
</html>
