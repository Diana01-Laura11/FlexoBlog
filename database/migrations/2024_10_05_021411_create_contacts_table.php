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
        Schema::create('contacts', function (Blueprint $table) {
            $table->integer('id_contacts', true);
            $table->string('full_name', 45);
            $table->string('email', 45);
            $table->bigInteger('phone');
            $table->string('affair', 45);
            $table->string('message', 45);
            $table->string('another_message', 45);
            $table->string('reference_page', 45);
            $table->string('current_page', 45);
            $table->string('ip', 45);
            $table->dateTime('date_time');
            $table->string('user_info', 45);
            $table->string('captcha', 45);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
