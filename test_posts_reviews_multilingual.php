<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Pet Posts and Reviews multilingual functionality:\n\n";

// Test Pet Posts
echo "=== Pet Posts ===\n";
$petPosts = App\Models\PetPost::all();
foreach ($petPosts as $post) {
    echo "Post ID: {$post->id}\n";

    // Test English
    app()->setLocale('en');
    echo "  English Title: " . $post->title . "\n";
    echo "  English Content: " . substr($post->content, 0, 50) . "...\n";

    // Test Arabic
    app()->setLocale('ar');
    echo "  Arabic Title: " . $post->title . "\n";
    echo "  Arabic Content: " . substr($post->content, 0, 50) . "...\n";
    echo "\n";
}

// Test Reviews
echo "=== Reviews ===\n";
$reviews = App\Models\Review::all();
foreach ($reviews as $review) {
    echo "Review ID: {$review->id}\n";

    // Test English
    app()->setLocale('en');
    echo "  English Reviewer Name: " . $review->reviewer_name . "\n";
    echo "  English Content: " . substr($review->content, 0, 50) . "...\n";

    // Test Arabic
    app()->setLocale('ar');
    echo "  Arabic Reviewer Name: " . $review->reviewer_name . "\n";
    echo "  Arabic Content: " . substr($review->content, 0, 50) . "...\n";
    echo "\n";
}

echo "Test completed.\n";
