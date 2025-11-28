<?php

namespace Database\Seeders\Concerns;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

trait HandlesSeedImages
{
    /**
     * Copy an image from public assets into the public storage disk and return its storage path.
     */
    protected function seedImage(string $assetFilename, string $modelName, string $fieldName, ?string $targetFilename = null, ?string $storageDirectory = null): string
    {
        $sourcePath = public_path('assets/images/' . $assetFilename);

        if (!File::exists($sourcePath)) {
            throw new RuntimeException("Seed image not found: {$assetFilename}");
        }

        $storageDirectory = $storageDirectory ?: "images/{$modelName}/{$fieldName}";
        $targetFilename = $targetFilename ?: $assetFilename;
        $storagePath = "{$storageDirectory}/{$targetFilename}";

        if (!Storage::disk('public')->exists($storageDirectory)) {
            Storage::disk('public')->makeDirectory($storageDirectory);
        }

        if (!Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->put($storagePath, File::get($sourcePath));
        }

        return $storagePath;
    }
}
