<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `classifications` de Hotelia.
     * Clasificaciones individuales dentro de un grupo
     * (ej. "Todo Incluido", "Familias", "Solo Adultos").
     */
    public function up(): void
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('classification_group_id');
            $table->integer('order')->default(1);
            $table->string('icon_class', 255)->nullable();

            $table->boolean('active')->default(true);
            $table->dateTime('created_at');
            $table->unsignedInteger('created_by')->default(0);
            $table->dateTime('updated_at');
            $table->unsignedInteger('updated_by')->default(0);

            $table->index('classification_group_id', 'idx-classifications-classification_group_id');
            $table->index('order', 'idx-classifications-order');

            $table->foreign('classification_group_id', 'fk-classifications-classification_group_id')
                ->references('id')->on('classification_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifications');
    }
};
