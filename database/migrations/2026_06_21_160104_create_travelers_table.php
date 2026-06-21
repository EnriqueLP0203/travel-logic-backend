<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `travelers` de Hotelia.
     * Perfil público del viajero que deja reseñas de hoteles.
     */
    public function up(): void
    {
        Schema::create('travelers', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->unsignedInteger('travelers_auth_id');

            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->tinyInteger('gender')->default(0);
            $table->string('phone', 15)->nullable();
            $table->string('country', 45)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('public_photo', 250)->nullable();
            $table->boolean('newsletter')->default(true);
            $table->boolean('active')->default(true);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->index('travelers_auth_id', 'idx-travelers-travelers_auth_id');

            $table->foreign('travelers_auth_id', 'fk-travelers-travelers_auth_id')
                ->references('id')->on('travelers_auth')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travelers');
    }
};
