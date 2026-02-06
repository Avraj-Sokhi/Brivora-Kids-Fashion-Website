<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$products = \App\Models\Product::doesntHave('images')->get();
echo "Products missing images:\n";
foreach ($products as $product) {
    echo "- " . $product->name . "\n";
}
