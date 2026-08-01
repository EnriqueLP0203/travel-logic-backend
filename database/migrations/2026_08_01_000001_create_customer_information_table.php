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
        Schema::create('customer_information', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->string('username', 100)->unique();
            $table->string('agency_name', 250);
            $table->string('legal_name', 250);
            $table->string('logo_url', 500)->nullable();
            $table->string('password', 255);

            $table->string('contact_person', 250);
            $table->string('email', 150)->unique();
            $table->string('country', 100);
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('phone', 20)->nullable();
            $table->string('mobile', 20)->nullable();

            $table->string('billing_manager', 250)->nullable();
            $table->string('billing_email', 150)->nullable();
            $table->string('billing_address', 250);
            $table->string('billing_country', 100)->nullable();
            $table->string('billing_state', 100)->nullable();
            $table->string('billing_city', 100)->nullable();
            $table->string('billing_zip_code', 20);
            $table->string('billing_phone', 20)->nullable();
            $table->string('billing_phone_2', 20)->nullable();
            $table->string('billing_mobile', 20)->nullable();
            $table->string('billing_tax_id', 100);
            $table->boolean('billing_same_as_contact')->default(false);

            $table->boolean('is_reviewed')->default(false);
            $table->boolean('is_accepted')->nullable();
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
        Schema::dropIfExists('customer_information');
    }
};
