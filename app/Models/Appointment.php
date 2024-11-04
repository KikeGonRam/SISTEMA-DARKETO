<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barber_id', // Asegúrate de que tengas esta columna en tu tabla appointments
        'appointment_time',
        'status',
        'date',
        'time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // App\Models\Appointment.php

    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id'); // Asegúrate de que barber_id sea la clave foránea
    }
}