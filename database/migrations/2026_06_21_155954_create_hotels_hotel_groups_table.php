<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Pivote muchos a muchos entre hoteles y grupos de hotel.
     */
    public function up(): void
    {
        Schema::create('hotels_hotel_groups', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('hotel_id');
            $table->unsignedInteger('hotel_group_id');

            $table->unique(['hotel_id', 'hotel_group_id'], 'idx-hotels_hotel_groups-hotel_id-hotel_group_id');
            $table->index('hotel_group_id', 'idx-hotels_hotel_groups-hotel_group_id');

            $table->foreign('hotel_id', 'fk-hotels_hotel_groups-hotel_id')
                ->references('id')->on('hotels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('hotel_group_id', 'fk-hotels_hotel_groups-hotel_group_id')
                ->references('id')->on('hotel_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels_hotel_groups');
    }
};
