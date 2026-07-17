<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin',
                'email' => 'admin@travellogic.com',
                'password' => 'admintrav3l@2026',
            ],
        );
    }
}
