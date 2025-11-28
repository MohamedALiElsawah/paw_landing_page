<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Setting;

echo "Testing multilingual settings:\n";

echo "English locale:\n";
app()->setLocale('en');
echo "Site Name: " . Setting::getValue('site_name') . "\n";
echo "Hero Title: " . Setting::getValue('hero_title') . "\n";
echo "Hero Description: " . Setting::getValue('hero_description') . "\n";

echo "\nArabic locale:\n";
app()->setLocale('ar');
echo "Site Name: " . Setting::getValue('site_name') . "\n";
echo "Hero Title: " . Setting::getValue('hero_title') . "\n";
echo "Hero Description: " . Setting::getValue('hero_description') . "\n";

echo "\nMultilingual settings count: " . Setting::where('is_multilingual', true)->count() . "\n";

$multilingualSettings = Setting::where('is_multilingual', true)->pluck('key')->toArray();
echo "Multilingual settings: " . implode(', ', $multilingualSettings) . "\n";
