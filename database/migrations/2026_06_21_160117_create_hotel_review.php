<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `hotel_reviews` de Hotelia.
     * Reseñas de viajeros sobre un hotel, con moderación y respuesta del admin.
     */
    public function up(): void
    {
        Schema::create('hotel_reviews', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('hotel_id');
            $table->unsignedInteger('traveler_id');

            $table->text('review_text');
            $table->decimal('rating_overall', 2, 1)->default(0.0);
            $table->tinyInteger('rating_cleanliness');
            $table->tinyInteger('rating_service');
            $table->tinyInteger('rating_location');
            $table->tinyInteger('rating_facilities');
            $table->tinyInteger('rating_value');

            $table->enum('status', ['pending', 'approved', 'rejected', 'flagged'])
                ->default('pending');

            $table->integer('moderated_by');
            $table->integer('moderated_at');

            $table->text('admin_response')->nullable();
            $table->dateTime('admin_response_date')->nullable();
            $table->integer('admin_response_by')->nullable();

            $table->boolean('active')->default(true);
            $table->dateTime('created_at');
            $table->unsignedInteger('created_by')->default(0);
            $table->dateTime('updated_at');
            $table->unsignedInteger('updated_by')->default(0);

            $table->index('hotel_id', 'idx-hotel_reviews-hotel_id');
            $table->index('traveler_id', 'idx-hotel_reviews-traveler_id');

            // En Hotelia estas FK son ON DELETE NO ACTION (se conserva la reseña
            // aunque el hotel o el viajero se eliminen).
            $table->foreign('hotel_id', 'fk-hotel_reviews-hotel_id')
                ->references('id')->on('hotels')
                ->onUpdate('cascade')
                ->onDelete('no action');

            $table->foreign('traveler_id', 'fk-hotel_reviews-traveler_id')
                ->references('id')->on('travelers')
                ->onUpdate('cascade')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_reviews');
    }
};
