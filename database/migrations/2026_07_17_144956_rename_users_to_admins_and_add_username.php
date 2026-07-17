<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('users') && ! Schema::hasTable('admins')) {
            Schema::rename('users', 'admins');
        }

        if (! Schema::hasTable('admins') || Schema::hasColumn('admins', 'username')) {
            return;
        }

        Schema::table('admins', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
        });

        $admins = DB::table('admins')->whereNull('username')->orderBy('id')->get();

        foreach ($admins as $admin) {
            DB::table('admins')->where('id', $admin->id)->update([
                'username' => 'user_'.$admin->id,
            ]);
        }

        Schema::table('admins', function (Blueprint $table) {
            $table->unique('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('admins') && Schema::hasColumn('admins', 'username')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            });
        }

        if (Schema::hasTable('admins') && ! Schema::hasTable('users')) {
            Schema::rename('admins', 'users');
        }
    }
};
