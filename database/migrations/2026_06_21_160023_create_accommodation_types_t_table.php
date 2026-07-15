<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Traducciones de tipos de alojamiento.
     */
    public function up(): void
    {
        Schema::create('accommodation_types_t', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('accommodation_type_id');
            $table->string('language_code', 7);
            $table->string('name', 50);

            $table->index('accommodation_type_id', 'idx-accommodation_types_t-accommodation_type_id');
            $table->index('language_code', 'idx-accommodation_types_t-language_code');

            $table->foreign('accommodation_type_id', 'fk-accommodation_types_t-accommodation_type_id')
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
        Schema::dropIfExists('accommodation_types_t');
    }
};
