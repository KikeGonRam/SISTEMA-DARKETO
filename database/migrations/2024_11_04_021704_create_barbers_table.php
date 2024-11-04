<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarbersTable extends Migration
{
    public function up()
    {
        Schema::create('barbers', function (Blueprint $table) {
            $table->id(); // ID del barbero
            $table->string('name'); // Nombre del barbero
            $table->string('email')->unique(); // Correo electrónico
            $table->string('photo')->nullable(); // Ruta de la foto
            $table->timestamps(); // Fechas de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('barbers');
    }
}