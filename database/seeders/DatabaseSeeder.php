<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Starting comprehensive database seeding...');

        // Step 1: Copy all required images to storage
        $this->copyAllImagesToStorage();

        // Step 2: Create admin user if not exists
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@pawapp.net',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Step 3: Call all seeders
        $this->command->info('Running all seeders...');
        $this->call([
            ServiceSeeder::class,
            ClinicSeeder::class,
            StoreSeeder::class,
            PetPostSeeder::class,
            ReviewSeeder::class,
            PartnerSeeder::class,
            SettingSeeder::class,
            HomePageSettingsSeeder::class,
            BannerSeeder::class,
            ArabicTranslationSeeder::class,
            ImageMigrationSeeder::class,
            BannerImageMigrationSeeder::class,
        ]);

        $this->command->info('Database seeding completed successfully!');
        $this->command->info('All images have been copied to storage.');
        $this->command->info('All data is available in both English and Arabic.');
    }

    /**
     * Copy all required images from public/assets/images to storage
     */
    private function copyAllImagesToStorage(): void
    {
        $this->command->info('Copying all images to storage...');

        $imagesToCopy = [
            // Banner images
            'hero1.png',
            'hero2.png',
            'hero3.png',
            'catBanner.png',
            'banner_c.png',
            'hero_cover.svg',
            'Top Image Container.png',
            'Pawmic1 1.png',

            // Store images
            'store1.png',
            'store2.png',
            'store3.png',
            'store_banner1.png',
            'store_banner2.png',
            'store_banner3.png',

            // Clinic images
            'clinic1.png',
            'clinic2.png',
            'clinic3.png',
            'clinic4.png',
            'clinic5.png',
            'clinic6.png',

            // Partner logos
            'Partner logo-1.png',
            'Partner logo-2.png',
            'Partner logo-3.png',
            'Partner logo-4.png',
            'Partner logo-5.png',
            'Partner logo-6.png',
            'Partner logo-7.png',
            'Partner logo-8.png',
            'Partner logo.png',

            // Pet post images
            'post1.png',
            'post2.png',
            'post3.png',

            // Other images
            'logo1.png',
            'logo2.png',
            'logo3.png',
            'map.png',
            'team.png',
            'SOP.png',
            'Image (Ahmed Al-Rashid).png',
            'Image (Layla Hassan).png',
            'Image (Sarah Mohammed).png',
        ];

        $copiedCount = 0;
        $failedCount = 0;

        foreach ($imagesToCopy as $image) {
            $sourcePath = public_path('assets/images/' . $image);

            if (!File::exists($sourcePath)) {
                $this->command->warn("Source image not found: {$image}");
                $failedCount++;
                continue;
            }

            // Determine storage directory based on image type
            $storageDirectory = $this->getStorageDirectory($image);
            $storagePath = "{$storageDirectory}/{$image}";

            // Create directory if it doesn't exist
            if (!Storage::disk('public')->exists($storageDirectory)) {
                Storage::disk('public')->makeDirectory($storageDirectory);
            }

            // Copy image to storage
            if (!Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->put($storagePath, File::get($sourcePath));
                $copiedCount++;
                $this->command->info("✓ Copied: {$image} -> {$storagePath}");
            } else {
                $this->command->info("✓ Already exists: {$storagePath}");
            }
        }

        $this->command->info("Image copying completed: {$copiedCount} copied, {$failedCount} failed");
    }

    /**
     * Determine the appropriate storage directory for an image
     */
    private function getStorageDirectory(string $image): string
    {
        if (str_contains($image, 'hero') || str_contains($image, 'banner') || str_contains($image, 'catBanner')) {
            return 'images/banners/image';
        }

        if (str_contains($image, 'store')) {
            return 'images/stores/image';
        }

        if (str_contains($image, 'clinic')) {
            return 'images/clinics/image';
        }

        if (str_contains($image, 'Partner')) {
            return 'images/partners/image';
        }

        if (str_contains($image, 'post')) {
            return 'images/pet_posts/image';
        }

        return 'images/general';
    }
}
