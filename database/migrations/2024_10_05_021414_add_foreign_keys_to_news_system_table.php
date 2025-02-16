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
        Schema::table('news_system', function (Blueprint $table) {
            $table->foreign(['id_type_publication'], 'fk_type_publication')->references(['id_type_publication'])->on('type_publication')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_client'], 'id_client_fk')->references(['id_client'])->on('clients')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_system', function (Blueprint $table) {
            $table->dropForeign('fk_type_publication');
            $table->dropForeign('id_client_fk');
        });
    }
};
