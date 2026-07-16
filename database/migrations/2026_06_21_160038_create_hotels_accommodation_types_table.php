<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Pivote muchos a muchos entre hoteles y tipos de alojamiento.
     */
    public function up(): void
    {
        Schema::create('hotels_accommodation_types', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('hotel_id');
            $table->unsignedInteger('accommodation_type_id');

            $table->unique(['hotel_id', 'accommodation_type_id'], 'idx-hotels_accommodation_types-hotel_id-accommodation_type_id');
            $table->index('accommodation_type_id', 'idx-hotels_accommodation_types-accommodation_type_id');

            $table->foreign('hotel_id', 'fk-hotels_accommodation_types-hotel_id')
                ->references('id')->on('hotels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('accommodation_type_id', 'fk-hotels_accommodation_types-accommodation_type_id')
                ->references('id')->on('accommodation_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels_accommodation_types');
    }
};
