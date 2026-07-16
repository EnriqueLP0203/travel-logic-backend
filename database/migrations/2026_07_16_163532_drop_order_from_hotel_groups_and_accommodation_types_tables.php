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
        Schema::table('hotel_groups', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('accommodation_types', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_groups', function (Blueprint $table) {
            $table->integer('order')->default(1)->after('id');
        });

        Schema::table('accommodation_types', function (Blueprint $table) {
            $table->integer('order')->default(1)->after('id');
        });
    }
};
