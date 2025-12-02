<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Clinic;

$clinics = Clinic::all();
foreach ($clinics as $index => $clinic) {
    $clinic->order = $index + 1;
    $clinic->save();
}

echo 'Updated ' . count($clinics) . ' clinics with order values.' . PHP_EOL;
