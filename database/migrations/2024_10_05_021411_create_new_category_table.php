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
        Schema::create('new_categories', function (Blueprint $table) {
            $table->id();  // Crea una columna 'id' como clave primaria auto-incremental
            $table->string('name_category', 255);
            $table->string('alias', 255);
            $table->boolean('status');  // tinyint(1) es representado como boolean
            $table->timestamps();  // Esto crea las columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_categories');
    }
};
