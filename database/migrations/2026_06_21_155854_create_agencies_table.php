<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `agencies` de Hotelia.
     * Agencias de viajes que pueden ayudar a agendar con los hoteles.
     */
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->string('comercial_name', 250);
            $table->string('business_name', 250);
            $table->string('logo_path', 250);
            $table->string('website', 100)->nullable();
            $table->string('email', 150);
            $table->string('phone', 15)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->text('bio')->nullable();

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
        Schema::dropIfExists('agencies');
    }
};
