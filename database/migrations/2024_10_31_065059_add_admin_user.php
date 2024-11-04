<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Crear el usuario admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@darketo.com',
            'password' => bcrypt('admin123'), // Cambia 'admin123' por la contraseña deseada
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Eliminar el usuario admin
        DB::table('users')->where('email', 'admin@darketo.com')->delete();
    }
};