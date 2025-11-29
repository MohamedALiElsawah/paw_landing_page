<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Checking stored images...\n\n";

// Check stores
echo "STORES:\n";
$stores = \App\Models\Store::all();
foreach ($stores as $store) {
    $name = json_decode($store->name, true)['en'] ?? $store->name;
    echo "Store: {$name} - Image: {$store->image}\n";

    // Check if file exists in storage
    if ($store->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($store->image)) {
        echo "  ✓ Image exists in storage\n";
    } else {
        echo "  ✗ Image NOT found in storage\n";
    }
}

echo "\n---\n\n";

// Check clinics
echo "CLINICS:\n";
$clinics = \App\Models\Clinic::all();
foreach ($clinics as $clinic) {
    $name = json_decode($clinic->name, true)['en'] ?? $clinic->name;
    echo "Clinic: {$name} - Image: {$clinic->image}\n";

    // Check if file exists in storage
    if ($clinic->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($clinic->image)) {
        echo "  ✓ Image exists in storage\n";
    } else {
        echo "  ✗ Image NOT found in storage\n";
    }
}

echo "\n---\n\n";

// Check banners
echo "BANNERS:\n";
$banners = \App\Models\Banner::all();
foreach ($banners as $banner) {
    $title = json_decode($banner->title, true)['en'] ?? $banner->title;
    echo "Banner: {$title}\n";
    echo "  Main Image: {$banner->getRawOriginal('image_url')}\n";
    echo "  Secondary: {$banner->getRawOriginal('secondary_image_url')}\n";
    echo "  Third: {$banner->getRawOriginal('third_image_url')}\n";

    // Check if files exist in storage
    $images = [
        'main' => $banner->getRawOriginal('image_url'),
        'secondary' => $banner->getRawOriginal('secondary_image_url'),
        'third' => $banner->getRawOriginal('third_image_url')
    ];

    foreach ($images as $type => $image) {
        if ($image && \Illuminate\Support\Facades\Storage::disk('public')->exists($image)) {
            echo "  ✓ {$type} image exists in storage\n";
        } else {
            echo "  ✗ {$type} image NOT found in storage\n";
        }
    }
    echo "\n";
}
