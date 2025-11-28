<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Store image for a specific model
     */
    public static function storeImage(UploadedFile $image, string $modelName, string $fieldName = 'image'): string
    {
        // Generate unique filename
        $extension = $image->getClientOriginalExtension();
        $filename = Str::slug($modelName) . '_' . $fieldName . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // Define storage path
        $storagePath = "images/{$modelName}/{$fieldName}";

        // Store the image
        $imagePath = $image->storeAs($storagePath, $filename, 'public');

        return $imagePath;
    }

    /**
     * Update image for a specific model
     */
    public static function updateImage(UploadedFile $image, string $modelName, ?string $oldImagePath = null, string $fieldName = 'image'): string
    {
        // Delete old image if exists
        if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
            Storage::disk('public')->delete($oldImagePath);
        }

        // Store new image
        return self::storeImage($image, $modelName, $fieldName);
    }

    /**
     * Delete image from storage
     */
    public static function deleteImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    /**
     * Get image URL for display
     */
    public static function getImageUrl(?string $imagePath): ?string
    {
        if (!$imagePath) {
            return null;
        }

        return asset('storage/' . $imagePath);
    }

    /**
     * Move existing static images to storage
     */
    public static function moveStaticImageToStorage(string $staticPath, string $modelName, string $fieldName = 'image'): string
    {
        $relativePath = ltrim($staticPath, '/');
        $possiblePaths = [
            public_path($relativePath),
            public_path('assets/' . $relativePath),
        ];

        $sourcePath = null;
        foreach ($possiblePaths as $path) {
            if (File::exists($path)) {
                $sourcePath = $path;
                break;
            }
        }

        if (!$sourcePath) {
            throw new \Exception("Static image not found: {$staticPath}");
        }

        // Generate unique filename
        $extension = pathinfo($staticPath, PATHINFO_EXTENSION);
        $filename = Str::slug($modelName) . '_' . $fieldName . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // Define storage path
        $storagePath = "images/{$modelName}/{$fieldName}";

        // Copy file to storage
        $destinationPath = "{$storagePath}/{$filename}";
        Storage::disk('public')->put($destinationPath, File::get($sourcePath));

        return $destinationPath;
    }

    /**
     * Get default image path for a model
     */
    public static function getDefaultImage(string $modelName, string $fieldName = 'image'): string
    {
        $defaultImages = [
            'clinics' => [
                'image' => 'assets/images/default-clinic.jpg',
            ],
            'stores' => [
                'image' => 'assets/images/default-store.jpg',
                'logo' => 'assets/images/default-logo.jpg',
            ],
            'pet_posts' => [
                'image' => 'assets/images/default-post.jpg',
            ],
            'reviews' => [
                'reviewer_image' => 'assets/images/default-avatar.jpg',
            ],
            'partners' => [
                'logo' => 'assets/images/default-logo.jpg',
            ],
        ];

        return $defaultImages[$modelName][$fieldName] ?? 'assets/images/default.jpg';
    }

    /**
     * Create storage directories for all models
     */
    public static function createStorageDirectories(): void
    {
        $directories = [
            'images/clinics/image',
            'images/stores/image',
            'images/stores/logo',
            'images/pet_posts/image',
            'images/reviews/reviewer_image',
            'images/partners/logo',
        ];

        foreach ($directories as $directory) {
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }
        }
    }
}
