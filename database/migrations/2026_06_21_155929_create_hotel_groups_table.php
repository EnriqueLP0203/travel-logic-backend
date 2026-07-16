<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Grupos de hotel (ej. Playa, Ciudad, Fiesta, Descanso, Lujo, Aeropuerto).
     */
    public function up(): void
    {
        Schema::create('hotel_groups', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->string('img_original_name', 255)->nullable();
            $table->string('img_new_name', 255)->nullable();
            $table->string('img_compound_name', 255)->nullable();
            $table->string('img_extension', 255)->nullable();
            $table->string('img_hash_name', 255)->nullable();
            $table->integer('img_file_size')->nullable()->default(0);

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
        Schema::dropIfExists('hotel_groups');
    }
};
