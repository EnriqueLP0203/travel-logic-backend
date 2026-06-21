<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Replica la tabla `travelers_auth` de Hotelia.
     * Autenticación de los viajeros que dejan reseñas (no son agencias ni admins).
     * Se incluye porque `hotel_reviews` depende de `travelers`, que a su vez
     * depende de esta tabla.
     */
    public function up(): void
    {
        Schema::create('travelers_auth', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->string('email', 255);
            $table->string('auth_key', 32);
            $table->string('password_hash', 60);
            $table->string('security_token', 255)->nullable();
            $table->string('registration_ip', 45)->nullable();
            $table->integer('confirmed_at')->nullable();
            $table->integer('blocked_at')->nullable();
            $table->integer('last_login_at')->nullable();
            $table->string('last_login_ip', 45)->nullable();
            $table->integer('password_changed_at')->nullable();
            $table->dateTime('updated_at');
            $table->dateTime('created_at');

            $table->unique('security_token', 'idx-travelers_auth-security_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travelers_auth');
    }
};
