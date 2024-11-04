<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a DARKETO Barber Shop</title>
    <!-- Cargar el CSS y JS usando Vite -->
    @vite(['resources/css/welcome.css', 'resources/js/welcome.js'])
</head>
<body>
    <!-- Fondo animado con partículas -->
    <div class="background-animation"></div>

    <!-- Contenedor principal de bienvenida -->
    <div class="welcome-container">
        <!-- Enlaces de sesión -->
        <div class="header">
            @if (Route::has('login'))
                <div class="p-6 text-right">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold hover:text-gray-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold hover:text-gray-300">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-semibold hover:text-gray-300">Registrar</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <!-- Contenido de bienvenida -->
        <div class="content">
            <h1>¡Bienvenido a DARKETO Barbería!</h1>
            <p>Experimenta los mejores cortes de cabello y servicios de barbería. Nuestros barberos expertos están aquí para ofrecerte un look fresco y una atmósfera relajante.</p>
            <p>Únete a nosotros hoy y disfruta de ofertas exclusivas y una experiencia de grooming premium.</p>
            <div class="mt-8 flex justify-center">
                <button onclick="showMore()">Explora Nuestros Servicios</button>
            </div>
            <!-- Información adicional oculta -->
            <div id="moreInfo" class="more-info">
                <p>Información adicional sobre los servicios.</p>
                <button onclick="hideMore()">Ocultar</button>
            </div>
        </div>

        <!-- Pie de página -->
        <footer>
            <p>&copy; 2024 DARKETO Barbería. Todos los derechos reservados.</p>
        </footer>
    </div>

    <!-- Cargar Three.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
</body>
</html>
