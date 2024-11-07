

# Proyecto de Gestión de Citas para Barbería - DARKETO

Este proyecto es una plataforma de gestión de citas para la barbería DARKETO, desarrollada con **Laravel 10**. El sistema permite a clientes agendar citas, explorar servicios, y a los barberos gestionar su agenda y disponibilidad. Además, incluye un sistema de administración para controlar todas las operaciones, productos y citas en la barbería.

## Características

- **Gestión de Citas**: Los clientes pueden agendar, consultar el estado y cancelar citas.
- **Roles de Usuarios**:
  - **Cliente**: Puede agendar citas, ver su historial de citas, y explorar servicios.
  - **Barbero**: Gestiona sus citas, precios, y descuentos. Solo necesita su correo para iniciar sesión.
  - **Administrador**: Tiene acceso completo al sistema, incluyendo la gestión de usuarios, citas, productos y barberos.
- **Panel de Administración**: Control completo de citas, productos y usuarios.
- **Tiendas de Productos**: Catálogo de productos de la barbería con opción de pago en línea mediante PayPal y Stripe.
- **Generación de Ticket en PDF**: Envía un recibo en PDF tras el pago de productos.
- **Animación de Fondo**: Efecto de neón con partículas en el fondo.
- **Integración de Pagos**: Soporte para pagos con PayPal y Stripe.
- **Autenticación con Google**: Opcional para clientes.
  
## Requerimientos

- **PHP 8.x**
- **Composer**
- **Node.js y npm**
- **Laravel 10**
- **MySQL** o cualquier otro sistema de base de datos compatible con Laravel

## Instalación

1. Clona el repositorio:

   ```bash
   git clone <URL-del-repositorio>
   cd darketo-barberia

2. Instala las dependencias de PHP y Node:
```bash
composer install
npm install && npm run build
```

3. Configura el archivo .env para conectar la base de datos y los servicios de terceros (Google, PayPal, Stripe).


4. Genera la clave de la aplicación:

php artisan key:generate


5. Migra la base de datos:

php artisan migrate


6. Inicia el servidor local:

php artisan serve



Acceso a Usuarios

Administrador:

Correo: admin@darketo.com

Contraseña: admin123@


Barbero: Inicia sesión usando solo su correo electrónico registrado.


Funcionalidades Clave

Gestión de Citas: Vista completa de citas con opciones de aceptación, cancelación, y marcado como pendiente.

Panel de Control de Barbero: Los barberos pueden gestionar citas y precios.

Panel de Cliente: Muestra el estado de las citas con etiquetas de colores para identificar su estado (pendiente, aceptada, cancelada).

Administración de Productos: Gestión de productos con integración de pagos.

Generación de PDF: Recepción de un ticket en PDF después de realizar el pago de productos.


Tecnologías

Laravel 10

Laravel Fortify y Sanctum para la autenticación.

Livewire y Blade para componentes interactivos.

Tailwind CSS para estilos.

Vite como herramienta de construcción.

Laravel Scheduler y colas para tareas y notificaciones.

PayPal y Stripe para integración de pagos en línea.

Dompdf o Laravel Snappy para generación de PDF.

Telescope y Debugbar para depuración en desarrollo.


Documentación Técnica

Para un manual de usuario completo y guía de instalación, visita el archivo de documentación en docs.


Contribución

1. Haz un fork del proyecto.


2. Crea una rama nueva (git checkout -b feature/nueva-funcionalidad).


3. Realiza tus cambios y crea commits descriptivos.


4. Abre un pull request detallando tus cambios.



Pruebas Automatizadas

Usamos herramientas de prueba como Playwright y alternativas a Selenium compatibles con PHP. Para ejecutar las pruebas, sigue la configuración descrita en el archivo tests/README.md.


---

Notas

Para el ingreso como administrador, recuerda usar el correo admin@darketo.com y la contraseña admin123@.


---

Contacto

Para más información o soporte, por favor contacta al equipo de desarrollo a través de [info@darketo.com].

¿Te gustaría que el README incluya instrucciones sobre cómo configurar Google OAuth, o ya tienes esto implementado?

