<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Solo name, slug y timestamps quedan obligatorios sin default.
     */
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->unsignedInteger('destination_id')->nullable()->change();
            $table->string('address', 500)->nullable()->change();
            $table->string('postal_code', 10)->nullable()->change();
            $table->decimal('latitude', 12, 7)->nullable()->change();
            $table->decimal('longitude', 12, 7)->nullable()->change();
            $table->string('hotel_detail_id', 50)->nullable()->change();
            $table->string('hotel_code', 50)->nullable()->change();
            $table->string('supplier_id', 50)->nullable()->change();
            $table->string('supplier_name', 150)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->unsignedInteger('destination_id')->nullable(false)->change();
            $table->string('address', 500)->nullable(false)->change();
            $table->string('postal_code', 10)->nullable(false)->change();
            $table->decimal('latitude', 12, 7)->nullable(false)->change();
            $table->decimal('longitude', 12, 7)->nullable(false)->change();
            $table->string('hotel_detail_id', 50)->nullable(false)->change();
            $table->string('hotel_code', 50)->nullable(false)->change();
            $table->string('supplier_id', 50)->nullable(false)->change();
            $table->string('supplier_name', 150)->nullable(false)->change();
        });
    }
};
