<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Cambiar a Authenticatable
use Illuminate\Notifications\Notifiable; // Importa el trait Notifiable

class Barber extends Authenticatable // Cambiar a Authenticatable
{
    use HasFactory, Notifiable; // Usa los traits HasFactory y Notifiable

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'name',
        'email',
        'photo', // Campo para la foto del barbero
    ];

    // Opcional: Si no usas contraseñas, puedes añadir un método para evitar errores
    public function getAuthPassword()
    {
        return null; // No hay contraseña que retornar
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Asumiendo que User es el modelo para los clientes
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    // Asegúrate de definir la tabla si no se llama 'barbers'
    protected $table = 'barbers';

    // Define los campos que pueden ser asignados masivamente
}