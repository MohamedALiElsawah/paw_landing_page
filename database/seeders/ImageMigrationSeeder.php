<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Store;
use App\Models\PetPost;
use App\Models\Review;
use App\Models\Partner;
use App\Services\ImageService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating storage directories...');
        ImageService::createStorageDirectories();

        $this->command->info('Migrating static images to storage...');

        // Migrate Clinic images
        $this->migrateClinics();

        // Migrate Store images
        $this->migrateStores();

        // Migrate PetPost images
        $this->migratePetPosts();

        // Migrate Review images
        $this->migrateReviews();

        // Migrate Partner images
        $this->migratePartners();

        $this->command->info('Image migration completed successfully!');
    }

    private function migrateClinics(): void
    {
        $clinics = Clinic::all();
        $migrated = 0;

        foreach ($clinics as $clinic) {
            if ($clinic->image && !str_contains($clinic->image, 'storage/')) {
                try {
                    $newImagePath = ImageService::moveStaticImageToStorage($clinic->image, 'clinics', 'image');
                    $clinic->update(['image' => $newImagePath]);
                    $migrated++;
                } catch (\Exception $e) {
                    $this->command->warn("Failed to migrate clinic image: {$e->getMessage()}");
                }
            }
        }

        $this->command->info("Migrated {$migrated} clinic images");
    }

    private function migrateStores(): void
    {
        $stores = Store::all();
        $migratedImages = 0;
        $migratedLogos = 0;

        foreach ($stores as $store) {
            // Migrate main image
            if ($store->image && !str_contains($store->image, 'storage/')) {
                try {
                    $newImagePath = ImageService::moveStaticImageToStorage($store->image, 'stores', 'image');
                    $store->update(['image' => $newImagePath]);
                    $migratedImages++;
                } catch (\Exception $e) {
                    $this->command->warn("Failed to migrate store image: {$e->getMessage()}");
                }
            }

            // Migrate logo
            if ($store->logo && !str_contains($store->logo, 'storage/')) {
                try {
                    $newLogoPath = ImageService::moveStaticImageToStorage($store->logo, 'stores', 'logo');
                    $store->update(['logo' => $newLogoPath]);
                    $migratedLogos++;
                } catch (\Exception $e) {
                    $this->command->warn("Failed to migrate store logo: {$e->getMessage()}");
                }
            }
        }

        $this->command->info("Migrated {$migratedImages} store images and {$migratedLogos} store logos");
    }

    private function migratePetPosts(): void
    {
        $petPosts = PetPost::all();
        $migrated = 0;

        foreach ($petPosts as $post) {
            if ($post->image && !str_contains($post->image, 'storage/')) {
                try {
                    $newImagePath = ImageService::moveStaticImageToStorage($post->image, 'pet_posts', 'image');
                    $post->update(['image' => $newImagePath]);
                    $migrated++;
                } catch (\Exception $e) {
                    $this->command->warn("Failed to migrate pet post image: {$e->getMessage()}");
                }
            }
        }

        $this->command->info("Migrated {$migrated} pet post images");
    }

    private function migrateReviews(): void
    {
        $reviews = Review::all();
        $migrated = 0;

        foreach ($reviews as $review) {
            if ($review->reviewer_image && !str_contains($review->reviewer_image, 'storage/')) {
                try {
                    $newImagePath = ImageService::moveStaticImageToStorage($review->reviewer_image, 'reviews', 'reviewer_image');
                    $review->update(['reviewer_image' => $newImagePath]);
                    $migrated++;
                } catch (\Exception $e) {
                    $this->command->warn("Failed to migrate review image: {$e->getMessage()}");
                }
            }
        }

        $this->command->info("Migrated {$migrated} review images");
    }

    private function migratePartners(): void
    {
        $partners = Partner::all();
        $migrated = 0;

        foreach ($partners as $partner) {
            if ($partner->logo && !str_contains($partner->logo, 'storage/')) {
                try {
                    $newLogoPath = ImageService::moveStaticImageToStorage($partner->logo, 'partners', 'logo');
                    $partner->update(['logo' => $newLogoPath]);
                    $migrated++;
                } catch (\Exception $e) {
                    $this->command->warn("Failed to migrate partner logo: {$e->getMessage()}");
                }
            }
        }

        $this->command->info("Migrated {$migrated} partner logos");
    }
}
