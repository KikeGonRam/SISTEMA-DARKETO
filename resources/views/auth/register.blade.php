<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro - DARKETO Barber Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            overflow: hidden; /* Elimina el desplazamiento */
            color: #ffffff; /* Color de texto blanco */
            font-family: 'Arial', sans-serif; /* Fuente más elegante */
        }
        .form-container {
            background-color: rgba(44, 44, 44, 0.9); /* Fondo gris oscuro para el formulario */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            padding: 2rem; /* Espaciado interno */
            position: relative; /* Para la colocación absoluta */
            z-index: 1; /* Para que el formulario esté encima del fondo */
        }
        .form-label {
            color: #ffffff; /* Color de las etiquetas */
        }
        .btn-primary {
            background-color: #dc3545; /* Color rojo para el botón */
            border: none;
            transition: background-color 0.3s; /* Efecto de transición */
        }
        .btn-primary:hover {
            background-color: #c82333; /* Color más oscuro al pasar el mouse */
        }
        h2 {
            font-weight: bold; /* Texto en negrita */
            text-align: center; /* Centrar el texto */
            margin-bottom: 1.5rem; /* Espacio inferior */
        }
        .text-danger {
            font-size: 0.9rem; /* Tamaño de fuente más pequeño para mensajes de error */
        }
        canvas {
            position: absolute; /* Lienzo en posición absoluta */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0; /* Para que esté detrás del formulario */
        }
    </style>
</head>
<body>
    <canvas id="backgroundCanvas"></canvas>
    <div class="container mt-5">
        <div class="max-w-md mx-auto form-container">
            <h2>Registro en DARKETO Barber Shop</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nombre') }}</label>
                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="text-danger mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a class="text-white" href="{{ route('login') }}">
                        {{ __('¿Ya estás registrado?') }}
                    </a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Registrar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        // Configuración del lienzo
        const canvas = document.getElementById('backgroundCanvas');
        const renderer = new THREE.WebGLRenderer({ alpha: true });
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight);
        camera.position.z = 300; // Ajustar la posición de la cámara

        // Ajusta el tamaño del lienzo al tamaño de la ventana
        renderer.setSize(window.innerWidth, window.innerHeight);
        canvas.appendChild(renderer.domElement);

        // Crear una fuente de luz
        const pointLight = new THREE.PointLight(0xFFFFFF, 2.5);
        scene.add(pointLight);

        const geometry = new THREE.SphereGeometry(10, 32, 16);
        const material = new THREE.MeshToonMaterial({
            color: 0xffcc33,
            transparent: true,
            opacity: 1,
            side: THREE.DoubleSide,
        });

        const group = new THREE.Group();
        const meshes = []; // Array para almacenar las esferas
        const velocities = []; // Array para almacenar las velocidades de las esferas

        // Crear y posicionar las esferas aleatorias
        for (let i = 0; i < 200; i++) {
            let mesh = new THREE.Mesh(geometry, material);
            mesh.position.x = Math.random() * 400 - 200; // Espacio mayor para más variación
            mesh.position.y = Math.random() * 400 - 200; // Espacio mayor para más variación
            mesh.position.z = Math.random() * 400 - 200; // Espacio mayor para más variación
            group.add(mesh);
            meshes.push(mesh); // Guardar la esfera en el array
            
            // Asignar una velocidad aleatoria a cada esfera
            velocities.push(new THREE.Vector3(
                (Math.random() - 0.5) * 0.5, // Velocidad en X
                (Math.random() - 0.5) * 0.5, // Velocidad en Y
                (Math.random() - 0.5) * 0.5  // Velocidad en Z
            ));
        }
        scene.add(group);

        // Animación
        function animate() {
            requestAnimationFrame(animate);

            // Mover cada esfera suavemente
            meshes.forEach((mesh, index) => {
                mesh.position.add(velocities[index]); // Mover la esfera según su velocidad

                // Cambiar dirección al llegar a los límites
                if (Math.abs(mesh.position.x) > 200) velocities[index].x *= -1;
                if (Math.abs(mesh.position.y) > 200) velocities[index].y *= -1;
                if (Math.abs(mesh.position.z) > 200) velocities[index].z *= -1;

                mesh.rotation.x += 0.01; // Rotación suave en X
                mesh.rotation.y += 0.01; // Rotación suave en Y
            });
            renderer.render(scene, camera);
        }

        animate(); // Inicia la animación

        // Ajustar el tamaño del lienzo al redimensionar la ventana
        window.addEventListener('resize', () => {
            renderer.setSize(window.innerWidth, window.innerHeight);
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
        });
    </script>
</body>
</html>
