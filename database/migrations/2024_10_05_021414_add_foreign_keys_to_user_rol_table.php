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
        Schema::table('user_rol', function (Blueprint $table) {
            $table->foreign(['rol_id'], 'fk_roles')->references(['id_rol'])->on('rol')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'fk_users')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_rol', function (Blueprint $table) {
            $table->dropForeign('fk_roles');
            $table->dropForeign('fk_users');
        });
    }
};
