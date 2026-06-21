<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Catálogo de idiomas usado por las tablas de traducción (_t).
     */
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 32);
            $table->string('code', 7);
            $table->string('symbol', 11);
            $table->boolean('default_lang')->default(false);
            $table->boolean('active')->default(true);
            $table->dateTime('created_at');
            $table->unsignedInteger('created_by')->default(0);
            $table->dateTime('updated_at');
            $table->unsignedInteger('updated_by')->default(0);

            $table->unique('code', 'idx-languages-code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
