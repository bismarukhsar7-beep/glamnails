<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Seed a default admin user.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['password' => 'admin123']
        );
    }
}















