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
        Schema::table('promotions_system', function (Blueprint $table) {
            $table->foreign(['id_client'], 'fk_client_id')->references(['id_client'])->on('clients')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_type_publication'], 'fk_id_publication_type')->references(['id_type_publication'])->on('type_publication')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotions_system', function (Blueprint $table) {
            $table->dropForeign('fk_client_id');
            $table->dropForeign('fk_id_publication_type');
        });
    }
};
