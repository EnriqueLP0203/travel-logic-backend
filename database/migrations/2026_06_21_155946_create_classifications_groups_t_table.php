<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `classification_groups_t` de Hotelia.
     * Nombre traducido de cada grupo de clasificación.
     */
    public function up(): void
    {
        Schema::create('classification_groups_t', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('classification_group_id');
            $table->string('language_code', 7);
            $table->string('classification_group_name', 50);

            $table->index('classification_group_id', 'idx-classification_groups_t-classification_group_id');
            $table->index('language_code', 'idx-classification_groups_t-language_code');

            $table->foreign('classification_group_id', 'fk-classification_groups_t-classification_group_id')
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
        Schema::dropIfExists('classification_groups_t');
    }
};
