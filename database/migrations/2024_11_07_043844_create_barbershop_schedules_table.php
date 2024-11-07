<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barbershop_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day_of_week'); // Día de la semana
            $table->time('opening_time'); // Hora de apertura
            $table->time('closing_time'); // Hora de cierre
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barbershop_schedules');
    }
};