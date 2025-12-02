<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Store;

$stores = Store::all();
foreach ($stores as $index => $store) {
    $store->order = $index + 1;
    $store->save();
}

echo 'Updated ' . count($stores) . ' stores with order values.' . PHP_EOL;
