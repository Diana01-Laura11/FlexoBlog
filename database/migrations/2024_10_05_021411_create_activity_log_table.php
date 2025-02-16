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
        Schema::create('activity_log', function (Blueprint $table) {
            $table->integer('id_activity_log', true);
            $table->dateTime('date');
            $table->string('ip', 45);
            $table->string('user_info', 45);
            $table->string('description', 45);
            $table->string('system_user', 45);
            $table->integer('publication_id')->index('fk_publication_id_idx');

            $table->unique(['id_activity_log', 'publication_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
