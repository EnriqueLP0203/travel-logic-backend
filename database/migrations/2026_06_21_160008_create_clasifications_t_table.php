<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `classifications_t` de Hotelia.
     * Nombre traducido de cada clasificación.
     */
    public function up(): void
    {
        Schema::create('classifications_t', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('classification_id');
            $table->string('language_code', 7);
            $table->string('classification_name', 50);

            $table->index('classification_id', 'idx-classifications_t-classification_id');
            $table->index('language_code', 'idx-classifications_t-language_code');

            $table->foreign('classification_id', 'fk-classifications_t-classification_id')
                ->references('id')->on('classifications')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifications_t');
    }
};
