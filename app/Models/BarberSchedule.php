<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarberSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['barber_id', 'day_of_week', 'start_time', 'end_time'];

    // Relación con Barber
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}