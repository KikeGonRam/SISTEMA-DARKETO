<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Agregar esta línea


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::table('users')
            ->where('email', 'admin@darketo.com')
            ->update(['is_admin' => true]);
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};