<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\PetPost;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

echo "Testing all image assignments...\n\n";

// Test Pet Posts
echo "PET POSTS:\n";
$petPosts = PetPost::all();
foreach ($petPosts as $post) {
    $title = json_decode($post->title, true)['en'] ?? $post->title;
    echo "Post: {$title}\n";
    echo "  Image: {$post->getRawOriginal('image')}\n";

    if ($post->getRawOriginal('image') && Storage::disk('public')->exists($post->getRawOriginal('image'))) {
        echo "  ✓ Image exists in storage\n";
    } else {
        echo "  ✗ Image NOT found in storage\n";
    }
    echo "\n";
}

echo "---\n\n";

// Test Partners
echo "PARTNERS:\n";
$partners = Partner::all();
foreach ($partners as $partner) {
    $name = json_decode($partner->name, true)['en'] ?? $partner->name;
    echo "Partner: {$name}\n";
    echo "  Logo: {$partner->getRawOriginal('logo')}\n";

    if ($partner->getRawOriginal('logo') && Storage::disk('public')->exists($partner->getRawOriginal('logo'))) {
        echo "  ✓ Logo exists in storage\n";
    } else {
        echo "  ✗ Logo NOT found in storage\n";
    }
    echo "\n";
}

echo "All image assignments verified!\n";
