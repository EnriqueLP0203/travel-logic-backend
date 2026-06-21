<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `hotels_t` de Hotelia.
     * Contenido traducido del hotel (descripciones, SEO) por idioma.
     */
    public function up(): void
    {
        Schema::create('hotels_t', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('hotel_id');
            $table->string('language_code', 7);

            $table->text('short_description');
            $table->text('description');
            $table->text('amenities');
            $table->string('meta_title', 255);
            $table->text('meta_description');
            $table->string('meta_keywords', 500);

            $table->index('hotel_id', 'idx-hotels_t-hotel_id');
            $table->index('language_code', 'idx-hotels_t-language_code');

            $table->foreign('hotel_id', 'fk-hotels_t-hotel_id')
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
        Schema::dropIfExists('hotels_t');
    }
};
