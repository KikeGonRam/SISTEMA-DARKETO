<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
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
use App\Http\Controllers\AppointmentController;

Route::middleware(['auth'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
});


//---------------------ruta de home--------------------------------
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
});// Agrupar rutas de admin bajo autenticación



use App\Http\Controllers\AdminController;

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

use App\Http\Controllers\UserController;
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
});

use App\Http\Controllers\BarberController;

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


use App\Http\Controllers\BarberAuthController;

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