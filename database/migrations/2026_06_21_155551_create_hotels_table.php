<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `hotels` de Hotelia.
     * Entidad principal: el hotel pertenece a un destino (RESTRICT en borrado).
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('destination_id');

            $table->string('name', 250);
            $table->tinyInteger('star_category')->default(1);
            $table->string('address', 500);
            $table->string('postal_code', 10);
            $table->decimal('latitude', 12, 7);
            $table->decimal('longitude', 12, 7);
            $table->string('phone', 50)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('website', 250)->nullable();
            $table->decimal('star_rating', 2, 1)->default(0.0);
            $table->string('price_range', 50)->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('is_published')->default(false);

            // Datos de integración con el proveedor / catálogo externo
            $table->string('hotel_detail_id', 50);
            $table->string('hotel_code', 50);
            $table->string('supplier_id', 50);
            $table->string('supplier_name', 150);

            $table->string('slug', 150);
            $table->boolean('active')->default(true);
            $table->dateTime('created_at');
            $table->unsignedInteger('created_by')->default(0);
            $table->dateTime('updated_at');
            $table->unsignedInteger('updated_by')->default(0);

            $table->unique('slug', 'idx-hotels-slug');
            $table->index('destination_id', 'idx-hotels-destination_id');

            // ON UPDATE CASCADE (sin ON DELETE explícito en el dump -> RESTRICT por defecto en InnoDB)
            $table->foreign('destination_id', 'fk-hotels-destination_id')
                ->references('id')->on('destinations')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
