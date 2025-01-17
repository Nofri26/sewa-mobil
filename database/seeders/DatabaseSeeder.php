<?php

namespace Database\Seeders;

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
            'no_telp' => '+628123456789',
            'alamat' => 'Kiaracondong, Bandung',
            'no_sim' => '123456789012',
            'email' => 'admin@admin.com',
        ]);
    }
}
