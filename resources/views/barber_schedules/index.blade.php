<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Horarios de barberos - Sistema de gestión de citas">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Horarios de Barberos - Panel de Control</title>
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --danger-color: #ef4444;
            --danger-hover: #dc2626;
            --warning-color: #fbbf24;
            --warning-hover: #d97706;
            --text-light: #ffffff;
            --border-color: rgba(255, 255, 255, 0.2);
            --background-overlay: rgba(0, 0, 0, 0.5);
        }

        /* Reset mejorado */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Mejoras de accesibilidad */
        :focus-visible {
            outline: 3px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Estilos base */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #000;
            font-family: system-ui, -apple-system, sans-serif;
            color: var(--text-light);
            line-height: 1.5;
        }

        /* Header mejorado */
        .header {
            background: rgba(0, 0, 0, 0.8);
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(10px);
        }

        .header a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .header a:hover {
            color: var(--primary-color);
        }

        .container {
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
            position: relative;
            z-index: 2;
        }

        h1 {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-align: center;
        }

        /* Botones mejorados */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: var(--text-light);
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: var(--text-light);
        }

        /* Tabla mejorada */
        .table-container {
            background: var(--background-overlay);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            margin-top: 2rem;
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th {
            background: rgba(0, 0, 0, 0.8);
            padding: 1rem;
            font-weight: 600;
            text-align: left;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .table tr:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Animación de partículas mejorada */
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
            background: radial-gradient(circle at center, 
                rgba(0, 0, 0, 0) 10%,
                rgba(0, 0, 0, 0.95) 90%
            );
        }

        @keyframes floatParticles {
            0% {
                transform: translate(0, 100vh) rotate(0deg);
                opacity: 0;
            }
            20% {
                opacity: 0.8;
            }
            80% {
                opacity: 0.8;
            }
            100% {
                transform: translate(var(--end-x), -100vh) rotate(var(--rotation));
                opacity: 0;
            }
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            filter: blur(1px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table-container {
                margin: 1rem -1rem;
                border-radius: 0;
            }

            .table th, .table td {
                padding: 0.75rem;
            }

            .btn {
                padding: 0.5rem 1rem;
            }
        }

        /* Loading animation */
        .loading {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .loading.active {
            display: block;
        }

        /* Toast notifications */
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            background: rgba(0, 0, 0, 0.9);
            color: white;
            transform: translateY(100%);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="background-animation" aria-hidden="true"></div>

    <header class="header">
        <nav>
            <a href="{{ route('barbershop_schedules.index')}}" aria-current="page">
                Horario de los Barberos
            </a>
        </nav>
    </header>

    <main class="container">
        <h1>Horarios de los Barberos</h1>

        <a href="{{ route('barber_schedules.create') }}" class="btn btn-primary" role="button">
            <span class="icon" aria-hidden="true">+</span>
            Agregar Horario
        </a>

        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="table" role="grid">
                    <thead>
                        <tr>
                            <th scope="col">Barbero</th>
                            <th scope="col">Día</th>
                            <th scope="col">Hora de Inicio</th>
                            <th scope="col">Hora de Fin</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->barber->name }}</td>
                            <td>{{ $schedule->day_of_week }}</td>
                            <td>{{ $schedule->start_time }}</td>
                            <td>{{ $schedule->end_time }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('barber_schedules.edit', $schedule->id) }}" 
                                       class="btn btn-warning"
                                       aria-label="Editar horario de {{ $schedule->barber->name }}">
                                        Editar
                                    </a>
                                    <form action="{{ route('barber_schedules.destroy', $schedule->id) }}" 
                                          method="POST" 
                                          class="inline delete-form"
                                          data-barber="{{ $schedule->barber->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach            
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="loading" role="status">
        <span class="sr-only">Cargando...</span>
    </div>

    <div class="toast" role="alert" aria-live="polite"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Configuración de partículas
            const particleConfig = {
                count: 30,
                colors: [
                    { bg: '#ff0000', shadow: '#ff4d4d' },
                    { bg: '#ffffff', shadow: '#cccccc' },
                    { bg: '#0000ff', shadow: '#4d4dff' }
                ],
                sizes: [
                    { min: 4, max: 8 },
                    { min: 6, max: 10 },
                    { min: 8, max: 12 }
                ]
            };

            const createParticleSystem = () => {
                const background = document.querySelector(".background-animation");
                
                // Limpia partículas existentes
                background.innerHTML = '';

                // Crear nuevas partículas con propiedades optimizadas
                for (let i = 0; i < particleConfig.count; i++) {
                    const particle = document.createElement("div");
                    particle.className = "particle";

                    // Propiedades aleatorias
                    const colorIndex = Math.floor(Math.random() * particleConfig.colors.length);
                    const sizeConfig = particleConfig.sizes[colorIndex];
                    const size = Math.random() * (sizeConfig.max - sizeConfig.min) + sizeConfig.min;

                    // Establecer variables CSS personalizadas
                    particle.style.setProperty('--end-x', `${Math.random() * 200 - 100}px`);
                    particle.style.setProperty('--rotation', `${Math.random() * 720 - 360}deg`);

                    // Aplicar estilos
                    Object.assign(particle.style, {
                        width: `${size}px`,
                        height: `${size}px`,
                        left: `${Math.random() * 100}vw`,
                        backgroundColor: particleConfig.colors[colorIndex].bg,
                        boxShadow: `0 0 15px ${particleConfig.colors[colorIndex].shadow}`,
                        animationDuration: `${Math.random() * 5 + 8}s`,
                        animationDelay: `${Math.random() * 5}s`
                    });

                    background.appendChild(particle);
                }
            };

            // Sistema de notificaciones mejorado
            const toast = {
                element: document.querySelector('.toast'),
                show(message, type = 'info') {
                    this.element.textContent = message;
                    this.element.className = `toast show toast-${type}`;
                    setTimeout(() => this.hide(), 3000);
                },
                hide() {
                    this.element.className = 'toast';
                }
            };

            // Manejador de formularios de eliminación
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const barberName = form.dataset.barber;
                    
                    if (confirm(`¿Estás seguro de que deseas eliminar el horario de ${barberName}?`)) {
                        try {
                            const response = await fetch(form.action, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                                }
                            });

                            if (response.ok) {
                                toast.show(`Horario de ${barberName} eliminado correctamente`, 'success');
                                form.closest('tr').remove();
                            } else {
                                throw new Error('Error al eliminar el horario');
                            }
                        } catch (error) {
                            toast.show('Error al eliminar el horario', 'error');
                            console.error('Error:', error);
                        }
                    }
                });
            });

            // Inicializar sistema de partículas
            createParticleSystem();

            // Recrear partículas al cambiar el tamaño de la ventana
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(createParticleSystem, 250);
            });
        });
    </script>
</body>
</html>