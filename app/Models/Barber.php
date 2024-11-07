<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Cambiar a Authenticatable solo si es necesario
use Illuminate\Notifications\Notifiable; // Importa el trait Notifiable
use Illuminate\Database\Eloquent\Model;

class Barber extends Authenticatable  // Solo si es necesario para autenticación
{
    use HasFactory, Notifiable;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'name',
        'email',
        'photo', // Campo para la foto del barbero
    ];

    // Si no usas contraseñas, puedes añadir un método para evitar errores
    public function getAuthPassword()
    {
        return null; // No hay contraseña que retornar
    }

    // Relación con el modelo User (si es correcto)
    public function user()
    {
        return $this->belongsTo(User::class); // Asumiendo que User es el modelo para los clientes
    }

    // Eliminar la relación barber() si no es necesaria, ya que no es necesario que un barbero tenga un barbero.
    // public function barber()
    // {
    //     return $this->belongsTo(Barber::class);
    // }

    // Asegúrate de definir la tabla si no se llama 'barbers'
    protected $table = 'barbers';

    // Define el accesor para la foto del barbero
    public function getPhotoAttribute($value)
    {
        // Devolver la URL completa de la foto almacenada en storage
        return $value ? asset('storage/barbers/' . $value) : null;
    }
}