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
        Schema::create('clients', function (Blueprint $table) {
            $table->integer('id_client', true);
            $table->string('name_client', 45);
            $table->string('last_name', 45);
            $table->string('email', 45);
            $table->string('company_name', 45);
            $table->string('rfc', 45);
            $table->dateTime('create_at');
            $table->dateTime('high_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
