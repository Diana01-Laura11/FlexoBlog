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
    Schema::create('promotions_system', function (Blueprint $table) {
        // Elimina la auto-incrementación de id_promotions
        $table->integer('id_promotions');
        $table->integer('id_type_publication')->index('fk_id_type_publication_idx');
        $table->string('title', 45);
        $table->string('alias', 45);
        $table->string('caption', 45);
        $table->string('content', 45);
        $table->string('status', 45);
        $table->dateTime('start_date');
        $table->dateTime('end_date');
        $table->string('conditions', 45);
        $table->string('extras', 45);
        $table->string('link', 45);
        $table->string('images', 45);
        $table->string('metadata', 45);
        $table->string('microdata', 45);
        $table->string('banners', 45);
        $table->string('forms', 45);
        $table->string('related_promotions', 45);
        $table->string('promotions_systemcol', 45);
        $table->integer('id_client')->index('fk_id_client_idx');

        // Define la clave primaria compuesta
        $table->primary(['id_promotions', 'id_type_publication', 'id_client']);
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions_system');
    }
};
