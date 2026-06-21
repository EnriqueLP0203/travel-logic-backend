<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `hotel_gallery` de Hotelia.
     * Imágenes asociadas a un hotel (una marcada como principal).
     */
    public function up(): void
    {
        Schema::create('hotel_gallery', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('hotel_id');

            $table->string('original_name', 255)->nullable();
            $table->string('new_name', 255)->nullable();
            $table->string('compound_name', 255)->nullable();
            $table->string('mime_type', 255)->nullable();
            $table->string('extension', 255)->nullable();
            $table->string('hash_name', 255)->nullable();
            $table->integer('file_size')->nullable()->default(0);

            $table->boolean('is_principal')->default(false);
            $table->boolean('active')->default(true);
            $table->dateTime('created_at');
            $table->unsignedInteger('created_by')->default(0);
            $table->dateTime('updated_at');
            $table->unsignedInteger('updated_by')->default(0);

            $table->index('hotel_id', 'idx-hotel_gallery-hotel_id');

            $table->foreign('hotel_id', 'fk-hotel_gallery-hotel_id')
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
        Schema::dropIfExists('hotel_gallery');
    }
};
