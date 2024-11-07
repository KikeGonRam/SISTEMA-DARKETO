<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarbershopSchedule extends Model
{
    use HasFactory;

     // Define los campos que pueden ser asignados masivamente
     protected $fillable = [
        'day_of_week',
        'opening_time',
        'closing_time',
    ];
}