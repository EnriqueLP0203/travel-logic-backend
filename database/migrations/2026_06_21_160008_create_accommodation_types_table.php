<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tipos de alojamiento (ej. Todo Incluido, Familias, Boutique).
     */
    public function up(): void
    {
        Schema::create('accommodation_types', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('order')->default(1);
            $table->string('icon_class', 255)->nullable();

            $table->boolean('active')->default(true);
            $table->dateTime('created_at');
            $table->unsignedInteger('created_by')->default(0);
            $table->dateTime('updated_at');
            $table->unsignedInteger('updated_by')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodation_types');
    }
};
