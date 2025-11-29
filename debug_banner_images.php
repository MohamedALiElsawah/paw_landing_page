<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

echo "Debugging banner image copying...\n\n";

$testImages = [
    'hero1.png',
    'hero2.png',
    'hero3.png',
    'catBanner.png',
    'banner_c.png',
    'hero_cover.svg',
    'Top Image Container.png',
    'Pawmic1 1.png'
];

foreach ($testImages as $image) {
    $sourcePath = public_path('assets/images/' . $image);
    echo "Checking: $image\n";

    if (!File::exists($sourcePath)) {
        echo "  ❌ Source file not found: $sourcePath\n";
        continue;
    }

    echo "  ✓ Source exists\n";

    $storageDirectory = "images/banners/image";
    $storagePath = "{$storageDirectory}/{$image}";

    if (!Storage::disk('public')->exists($storageDirectory)) {
        Storage::disk('public')->makeDirectory($storageDirectory);
        echo "  Created directory: $storageDirectory\n";
    }

    if (!Storage::disk('public')->exists($storagePath)) {
        Storage::disk('public')->put($storagePath, File::get($sourcePath));
        echo "  ✓ Copied to storage: $storagePath\n";
    } else {
        echo "  ✓ Already exists in storage: $storagePath\n";
    }

    echo "\n";
}

echo "Checking storage contents:\n";
$files = Storage::disk('public')->allFiles('images/banners');
foreach ($files as $file) {
    echo "  - $file\n";
}

echo "\nDone!\n";
