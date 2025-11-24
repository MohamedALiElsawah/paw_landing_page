<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@pawapp.net',
            'password' => bcrypt('password123'),
        ]);

        // Call other seeders
        $this->call([
            ServiceSeeder::class,
            ClinicSeeder::class,
            StoreSeeder::class,
            PetPostSeeder::class,
            ReviewSeeder::class,
            PartnerSeeder::class,
        ]);
    }
}
