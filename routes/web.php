<?php
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\BarberAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rutas Generales (Públicas)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Acceso Autenticado y Verificado)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil del Usuario (Acceso Autenticado)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de Citas (Protegidas por Autenticación)
Route::middleware(['auth'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
    Route::patch('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::get('/appointments/user/create', [AppointmentController::class, 'userCreate'])->name('appointments.user_create');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('appointments/store', [AppointmentController::class, 'userstore'])->name('appointments.store');
    Route::get('/user/citas', [AppointmentController::class, 'citas'])->name('users.citas');
});

// Panel de Administración (Acceso Autenticado y Administrador)
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
    Route::resource('barbers', BarberController::class);
    Route::get('barbers/{barber}', [BarberController::class, 'showw'])->name('barbers.show');
    Route::get('barbers/{barber}/edit', [BarberController::class, 'edit'])->name('barbers.edit');
    Route::put('barbers/{barber}', [BarberController::class, 'update'])->name('barbers.update');
    Route::put('barbers/{barber}/update-password', [BarberController::class, 'updatePassword'])->name('barbers.updatePassword');
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
});

// Rutas del Barbero (Autenticación de Barbero)
Route::get('/barbers/login', [BarberAuthController::class, 'showLoginForm'])->name('barbers.login');
Route::post('/barbers/login', [BarberAuthController::class, 'login'])->name('barbers.login.submit');

// Dashboard y Rutas de Barbero (Autenticación de Barbero)
Route::middleware(['auth:barber'])->group(function () {
    Route::get('/barbers/dashboard', [BarberController::class, 'dashboard'])->name('barbers.dashboard');
    Route::get('/barbers/{id}/appointments', [BarberController::class, 'show'])->name('barbers.appointments');
    Route::resource('appointments', AppointmentController::class);
    Route::get('/barbers/appointments', [BarberController::class, 'showAppointments'])->name('appointments.index');
});

// Rutas de Citas para Barberos (Protección con Middleware de Barbero)
Route::middleware(['auth', 'barber'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
    Route::get('/barbers/{id}/appointments', [BarberController::class, 'appointments'])->name('appointments.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//------------------------tuta de citas-------------------------------------------

Route::middleware(['auth'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
});


use app\http\Controllers\HomeController;
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});Route::middleware(['auth'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('appointments', AppointmentController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('appointments', AppointmentController::class);
});



Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
});


// Rutas protegidas por el AdminMiddleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Otras rutas que solo deberían ser accesibles por el administrador
});

// Rutas de barberos que solo necesitan autenticación de barberos
Route::middleware(['auth:barber'])->group(function () {
    Route::get('/barbers/dashboard', [BarberController::class, 'dashboard'])->name('barbers.dashboard');
    // Otras rutas para barberos
});



// Rutas para el barbero
Route::get('/barbers/login', [BarberAuthController::class, 'showLoginForm'])->name('barbers.login');
Route::post('/barbers/login', [BarberAuthController::class, 'login'])->name('barbers.login.submit');

// Rutas protegidas para barberos
Route::middleware(['auth:barber'])->group(function () {
    Route::get('/barbers/dashboard', [BarberController::class, 'dashboard'])->name('barbers.dashboard');
    // Otras rutas para barberos
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Rutas para gestionar barberos
    Route::resource('barbers', BarberController::class); // Esto define las rutas CRUD, incluyendo `barbers.index`
    
    // Otras rutas que solo deberían ser accesibles por el administrador
});


Route::patch('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');// En app/Http/Controllers/BarberController.php// En routes/web.php
Route::get('/barbers/appointments', [BarberController::class, 'showAppointments'])->name('appointments.index');Route::get('/barbers/appointments', [BarberController::class, 'showAppointments'])->name('appointments.index');

Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');

Route::get('/appointments/user/create', [AppointmentController::class, 'userCreate'])->name('appointments.user_create');

Route::middleware(['auth'])->group(function () {
    // Ruta para las citas del usuario
    Route::get('/user/citas', [AppointmentController::class, 'citas'])->name('users.citas');
});

Route::post('appointments/store', [AppointmentController::class, 'userstore'])->name('appointments.store');


Route::get('/barbers/appointments', [BarberController::class, 'showAppointments'])->name('appointments.index');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Otras rutas protegidas para el administrador
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


Route::middleware(['auth', 'barber'])->group(function () {
    Route::get('/barber/dashboard', [BarberController::class, 'dashboard'])->name('barber.dashboard');
});


Route::middleware(['auth', 'barber'])->group(function () {
    Route::get('/barbers/{id}/appointments', [BarberController::class, 'show'])->name('barbers.appointments');
});

Route::get('/barbers', [BarberController::class, 'index'])->name('barbers.index');

Route::resource('barbers', BarberController::class);

Route::get('barbers/{barber}', [BarberController::class, 'showw'])->name('barbers.show');

// Ruta para mostrar la vista de edición del barbero
Route::get('barbers/{barber}/edit', [BarberController::class, 'edit'])->name('barbers.edit');

// Ruta para actualizar los datos del barbero
Route::put('barbers/{barber}', [BarberController::class, 'update'])->name('barbers.update');

// Ruta para actualizar la contraseña del barbero
Route::put('barbers/{barber}/update-password', [BarberController::class, 'updatePassword'])->name('barbers.updatePassword');

Route::put('/barbers/{barber}/update-password', [BarberController::class, 'updatePassword'])->name('barbers.updatePassword');

Route::resource('appointments', AppointmentController::class);

Route::middleware('auth')->group(function() {
    Route::resource('appointments', AppointmentController::class);
});



// Si estás usando un controlador de recursos
Route::resource('appointments', AppointmentController::class);

// O si quieres que 'appointments' esté bajo 'barbers', deberías hacerlo de la siguiente manera:
Route::resource('barbers/appointments', AppointmentController::class);

// Anidando appointments bajo barbers
Route::prefix('barbers')->group(function() {
    Route::resource('appointments', AppointmentController::class);
});

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');


// routes/web.php

// Ruta para mostrar el formulario de creación de cita
Route::get('admin/appointments/create', [AdminController::class, 'createAppointment'])->name('admin.appointments.create');

// Ruta para guardar la cita
Route::post('admin/appointments/store', [AdminController::class, 'storeAppointment'])->name('admin.appointments.store');Route::get('admin/appointments', [AppointmentController::class, 'index'])->name('appointments.index');


// routes/web.php

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/gestionar-citas', [AppointmentController::class, 'index'])->name('appointments.index');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Rutas protegidas para administradores
});


Route::get('/appointments/create', [AppointmentController::class, 'user_create'])->name('appointments.user_create');

// Rutas de Citas (Protegidas por Autenticación)
Route::middleware('auth')->group(function () {
    Route::resource('appointments', AppointmentController::class);
    Route::patch('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::get('/appointments/user/create', [AppointmentController::class, 'userCreate'])->name('appointments.user_create');
    Route::post('appointments/store', [AppointmentController::class, 'userstore'])->name('appointments.store');
    Route::get('/user/citas', [AppointmentController::class, 'citas'])->name('users.citas');
});



Route::get('/users/indexx', [AppointmentController::class, 'indexx'])->name('users.index');


use App\Http\Controllers\BarberScheduleController;

// Grupo de rutas con autenticación para el administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('barber_schedules', BarberScheduleController::class)
        ->except(['show'])
        ->names([
            'index' => 'barber_schedules.index',
            'create' => 'barber_schedules.create',
            'store' => 'barber_schedules.store',
            'edit' => 'barber_schedules.edit',
            'update' => 'barber_schedules.update',
            'destroy' => 'barber_schedules.destroy'
        ]);
});



use App\Http\Controllers\BarbershopScheduleController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('barbershop_schedules', BarbershopScheduleController::class)
        ->except(['show']) // Excluimos 'show' si no lo necesitas
        ->names([
            'index' => 'barbershop_schedules.index',
            'create' => 'barbershop_schedules.create',
            'store' => 'barbershop_schedules.store',
            'edit' => 'barbershop_schedules.edit',
            'update' => 'barbershop_schedules.update',
            'destroy' => 'barbershop_schedules.destroy'
        ]);
});