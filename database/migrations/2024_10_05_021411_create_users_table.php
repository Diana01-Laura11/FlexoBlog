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
    if (!Schema::hasTable('users')) {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('lastname', 45)->nullable();
            $table->string('email', 45);
            $table->string('alias', 45)->nullable();
            $table->string('password', 100);
            $table->string('user_create', 45)->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->rememberToken();
        });
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
