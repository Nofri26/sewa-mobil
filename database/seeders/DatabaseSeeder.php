<?php

namespace Database\Seeders;

use App\Enum\User\Roles;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'address' => 'Kiaracondong, Bandung',
            'phone_number' => '+628123456789',
            'sim_number' => '123456789012',
            'role' => Roles::ADMIN,
            'email' => 'admin@admin.com',
        ]);
    }
}
