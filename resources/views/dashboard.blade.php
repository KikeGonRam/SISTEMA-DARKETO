<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Citas - DARKETO Barbería</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-900 text-white font-sans">
    <!-- Encabezado fijo -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 text-white p-4 shadow-lg fixed top-0 left-0 right-0 z-10">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo o título -->
            <h1 class="text-2xl font-extrabold tracking-widest text-blue-400 hover:text-blue-500 transition-colors duration-300">DARKETO Barbería</h1>
            
            <!-- Menú de opciones principal -->
            <nav class="space-x-6 hidden md:flex">
                <a href="{{ route('users.citas') }}" class="text-gray-300 hover:text-white transition duration-300">Citas</a>
                <a href="#" class="text-gray-300 hover:text-white transition duration-300">Catálogo de Cortes</a>
                <a href="#" class="text-gray-300 hover:text-white transition duration-300">Productos</a>
            </nav>
            
            <!-- Menú desplegable de usuario -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 text-gray-300 hover:text-white focus:outline-none">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 fill-current" :class="{'rotate-180': open}" viewBox="0 0 20 20">
                        <path d="M5.23 7.21a.75.75 0 011.06 0L10 10.88l3.71-3.67a.75.75 0 011.06 1.06l-4 4a.75.75 0 01-1.06 0l-4-4a.75.75 0 010-1.06z"/>
                    </svg>
                </button>
                <ul x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-md shadow-lg ring-1 ring-gray-700">
                    <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-300">Editar Perfil</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-300">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="container mx-auto p-8 mt-24">
        <h2 class="text-4xl font-bold text-center mb-8 text-blue-400">Bienvenido, {{ Auth::user()->name }}!</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
    </main>
</body>
</html>
