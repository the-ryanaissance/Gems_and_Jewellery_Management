<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$rows = App\Models\Product360Preview::query()
    ->with('product')
    ->get()
    ->map(fn ($preview) => [
        'preview_product_id' => $preview->product_id,
        'product_found' => (bool) $preview->product,
        'product_name' => $preview->product?->name,
        'folder_path' => $preview->folder_path,
        'frame_count' => $preview->frame_count,
    ]);
echo json_encode($rows->toArray(), JSON_PRETTY_PRINT);
