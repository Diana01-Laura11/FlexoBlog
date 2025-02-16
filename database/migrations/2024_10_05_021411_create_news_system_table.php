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
    Schema::create('news_system', function (Blueprint $table) {
        // Cambia 'id_publication' para que no sea auto-incremental o clave primaria
        $table->integer('id_publication'); // No como auto-incremental
        $table->integer('id_type_publication')->index('fk_type_publication_idx');
        $table->string('title', 45);
        $table->string('alias', 45);
        $table->string('contemt', 45);
        $table->string('status', 45);
        $table->dateTime('date_at');
        $table->dateTime('date_publication');
        $table->dateTime('date_modified');
        $table->string('author', 45);
        $table->string('imagenes', 45);
        // $table->string('ogdata', 45);
        $table->json('ogdata', 45);
        $table->string('microdata', 45);
        $table->string('banners', 45);
        $table->string('formularios', 45);
        $table->string('related_article', 45);
        $table->integer('id_client')->index('fk_id_client_idx');

        // Define la clave primaria compuesta
        $table->primary(['id_publication', 'id_type_publication', 'id_client']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_system');
    }
};
