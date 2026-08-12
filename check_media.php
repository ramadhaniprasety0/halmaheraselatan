<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$destinations = App\Models\Destination::all();
foreach ($destinations as $d) {
    echo "=== Destination ID: {$d->id} | {$d->name} ===\n";
    $media = $d->getMedia('default');
    echo "  Media count: " . $media->count() . "\n";
    foreach ($media as $m) {
        echo "  Media ID: {$m->id}\n";
        echo "  URL: " . $m->getUrl() . "\n";
        echo "  Path: " . $m->getPath() . "\n";
        echo "  File exists: " . (file_exists($m->getPath()) ? 'YES' : 'NO') . "\n";
    }
}
