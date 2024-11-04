<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión - DARKETO Barber Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/login.css', 'resources/js/login.js']) <!-- Actualiza la referencia a los archivos CSS y JS -->
</head>
<body>
    <div class="background-animation"></div>
    
    <div class="form-container">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label remember-me-label">{{ __('Recordarme') }}</label>
            </div>

            <div class="d-flex justify-content-between mt-4">
                @if (Route::has('password.request'))
                    <a class="text-white" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <button type="submit" class="btn btn-primary">
                    {{ __('Iniciar Sesión') }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>
