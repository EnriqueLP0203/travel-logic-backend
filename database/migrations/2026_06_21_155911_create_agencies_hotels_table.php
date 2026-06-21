<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla pivote `agencies_hotels` de Hotelia.
     * Relación muchos a muchos entre agencias y hoteles:
     * qué agencias pueden gestionar la reserva de qué hoteles.
     */
    public function up(): void
    {
        Schema::create('agencies_hotels', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('agency_id');
            $table->unsignedInteger('hotel_id');

            $table->unique(['agency_id', 'hotel_id'], 'idx-agencies_hotels-agency_id-hotel_id');
            $table->index('agency_id', 'idx-agencies_hotels-agency_id');
            $table->index('hotel_id', 'idx-agencies_hotels-hotel_id');

            $table->foreign('agency_id', 'fk-agencies_hotels-agency_id')
                ->references('id')->on('agencies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('hotel_id', 'fk-agencies_hotels-hotel_id')
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
        Schema::dropIfExists('agencies_hotels');
    }
};
