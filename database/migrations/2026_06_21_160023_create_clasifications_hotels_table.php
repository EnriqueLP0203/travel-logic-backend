<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla pivote `classifications_hotels` de Hotelia.
     * Relación muchos a muchos entre clasificaciones y hoteles.
     */
    public function up(): void
    {
        Schema::create('classifications_hotels', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('hotel_id');

            $table->unique(['classification_id', 'hotel_id'], 'idx-classifications_hotels-classification_id-hotel_id');
            $table->index('hotel_id', 'fk-classifications_hotels-hotel_id');

            $table->foreign('classification_id', 'fk-classifications_hotels-classification_id')
                ->references('id')->on('classifications')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('hotel_id', 'fk-classifications_hotels-hotel_id')
                ->references('id')->on('hotels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifications_hotels');
    }
};
