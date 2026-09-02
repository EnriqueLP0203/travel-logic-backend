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
        Schema::table('interested_clients', function (Blueprint $table) {
            // Renombrar 'name' → 'agent_name' para reflejar al agente de viajes
            $table->renameColumn('name', 'agent_name');

            // Nuevos campos del formulario
            $table->string('agency_name', 250)->after('id');
            $table->string('country', 250)->after('phone');
            $table->string('city', 250)->after('country');
            $table->string('service_type', 250)->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interested_clients', function (Blueprint $table) {
            $table->renameColumn('agent_name', 'name');
            $table->dropColumn(['agency_name', 'country', 'city', 'service_type']);
        });
    }
};
