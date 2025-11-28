<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user directly
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@pawapp.net',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Call other seeders
        $this->call([
            ServiceSeeder::class,
            ClinicSeeder::class,
            StoreSeeder::class,
            PetPostSeeder::class,
            ReviewSeeder::class,
            PartnerSeeder::class,
            SettingSeeder::class,
            BannerSeeder::class,
            ArabicTranslationSeeder::class,
            ImageMigrationSeeder::class,
        ]);
    }
}
