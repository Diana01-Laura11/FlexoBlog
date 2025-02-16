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
    Schema::create('items_system', function (Blueprint $table) {
        // Cambia esto para que solo se defina la clave primaria combinada
        $table->integer('id_items_system'); // No la declares como auto-incremento o clave primaria
        $table->integer('id_publication')->index('fk_id_publication_idx');
        $table->integer('id_publication_type')->index('fk_id_type_publication_idx');
        $table->string('title', 45);
        $table->string('alias', 45);
        $table->string('content', 45);
        $table->string('status', 45);
        $table->string('creation_date', 45);
        $table->string('items_systemcol', 45);
        $table->string('publication_date', 45);
        $table->string('modification_date', 45);
        $table->string('images', 45);
        $table->string('ogdata', 45);
        $table->string('metadata', 45);
        $table->string('microdata', 45);
        $table->string('banners', 45);
        $table->string('forms', 45);
        $table->string('related_downloadable_articles', 45);
        $table->integer('id_client');
        $table->integer('id_category')->index('fk_id_category_idx');

        // Define solo la clave primaria combinada
        $table->primary(['id_publication', 'id_publication_type', 'id_client', 'id_category']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_system');
    }
};
