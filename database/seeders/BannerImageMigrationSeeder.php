<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BannerImageMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = Banner::all();

        foreach ($banners as $banner) {
            // Skip if image_url is already a storage path or empty
            if (empty($banner->image_url) || str_contains($banner->image_url, 'storage/')) {
                continue;
            }

            // Extract filename from the current image_url
            $filename = basename($banner->image_url);
            $sourcePath = public_path('assets/images/' . $filename);

            // Check if source file exists
            if (File::exists($sourcePath)) {
                // Copy to storage
                $storagePath = 'banners/' . uniqid() . '_' . $filename;
                Storage::disk('public')->put($storagePath, File::get($sourcePath));

                // Update the banner record
                $banner->update(['image_url' => $storagePath]);

                $this->command->info("Migrated banner image: {$filename} -> {$storagePath}");
            } else {
                $this->command->warn("Source file not found: {$sourcePath}");
            }
        }

        $this->command->info('Banner image migration completed!');
    }
}
