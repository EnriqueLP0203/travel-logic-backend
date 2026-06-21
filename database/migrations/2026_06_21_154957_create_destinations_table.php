<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->string('country', 255);

            $table->string('img_original_name', 255)->nullable();
            $table->string('img_new_name', 255)->nullable();
            $table->string('img_compound_name', 255)->nullable();
            $table->string('img_extension', 255)->nullable();
            $table->string('img_hash_name', 255)->nullable();
            $table->integer('img_file_size')->nullable()->default(0);

            $table->string('slug', 150);
            $table->boolean('active')->default(true);
            $table->dateTime('created_at');
            $table->unsignedInteger('created_by')->default(0);
            $table->dateTime('updated_at');
            $table->unsignedInteger('updated_by')->default(0);

            $table->unique('slug', 'idx-destinations-slug');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
