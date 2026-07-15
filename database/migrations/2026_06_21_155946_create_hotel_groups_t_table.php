<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Traducciones de grupos de hotel.
     */
    public function up(): void
    {
        Schema::create('hotel_groups_t', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('hotel_group_id');
            $table->string('language_code', 7);
            $table->string('name', 50);

            $table->index('hotel_group_id', 'idx-hotel_groups_t-hotel_group_id');
            $table->index('language_code', 'idx-hotel_groups_t-language_code');

            $table->foreign('hotel_group_id', 'fk-hotel_groups_t-hotel_group_id')
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
        Schema::dropIfExists('hotel_groups_t');
    }
};
