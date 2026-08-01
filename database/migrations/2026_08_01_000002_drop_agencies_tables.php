<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('agencies_hotels');
        Schema::dropIfExists('agencies');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Las tablas agencies y agencies_hotels fueron eliminadas del proyecto.
    }
};
