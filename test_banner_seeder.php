<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Banner;
use Database\Seeders\BannerSeeder;

echo "Testing BannerSeeder image paths...\n\n";

// Create a test instance of the seeder
$seeder = new BannerSeeder();

// Test the seedImage method
$testImage = $seeder->seedImage('hero2.png', 'banners', 'image', 'hero2.png', 'banners');
echo "seedImage result: $testImage\n\n";

// Test creating a banner
$bannerData = [
    'title_en' => 'Test Banner',
    'title_ar' => 'بانر اختبار',
    'description_en' => 'Test description',
    'description_ar' => 'وصف اختبار',
    'image_url' => $seeder->seedImage('hero2.png', 'banners', 'image', 'hero2.png', 'banners'),
    'secondary_image_url' => $seeder->seedImage('banner_c.png', 'banners', 'image', 'hero2_secondary.png', 'banners'),
    'third_image_url' => $seeder->seedImage('hero2.png', 'banners', 'image', 'hero2_leo.png', 'banners'),
    'is_active' => true,
    'is_default' => false,
    'order' => 99,
    'button_text_en' => 'Test',
    'button_text_ar' => 'اختبار',
    'button_url' => '#'
];

$banner = Banner::create($bannerData);

echo "Created banner with data:\n";
echo "image_url: " . $banner->image_url . "\n";
echo "secondary_image_url: " . $banner->secondary_image_url . "\n";
echo "third_image_url: " . $banner->third_image_url . "\n\n";

// Clean up
$banner->delete();

echo "Test completed!\n";
