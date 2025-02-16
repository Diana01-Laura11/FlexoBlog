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
    Schema::create('galleries_system', function (Blueprint $table) {
        $table->integer('id_publication')->primary(); // Cambiado a primary si es necesario
        $table->integer('id_type_publication')->index('fk_gallery_publication_idx');
        $table->string('title', 45);
        $table->string('alias', 45);
        $table->string('status', 45);
        $table->string('content', 45);
        $table->string('testimonials', 45);
        $table->string('galleries_system', 45);
        $table->dateTime('publication_date');
        $table->dateTime('creation_date');
        $table->dateTime('modification_date');
        $table->string('tool', 45);
        $table->string('link', 45);
        $table->string('new_window', 45);
        $table->string('images', 45);
        $table->string('ogdata', 45);
        $table->string('microdata', 45);
        $table->string('metadata', 45);
        $table->string('forms', 45);
        $table->string('galleries_systemcol2', 45);
        $table->string('related_galleries', 45);
        $table->string('banners', 45);
        $table->integer('id_client')->index('fk_id_client_idx');

        // Proporcionar un nombre más corto para el índice único
        $table->unique(['id_publication', 'id_type_publication', 'id_client'], 'galleries_unique_idx');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries_system');
    }
};
