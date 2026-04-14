<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$books = \App\Models\Book::where('image', 'LIKE', 'http%')->get();
$count = 0;
foreach($books as $book) {
    echo "Processing {$book->name}...\n";
    try {
        $context = stream_context_create(['http' => ['ignore_errors' => true]]);
        $imgData = file_get_contents($book->image, false, $context);
        if ($imgData && strlen($imgData) > 500) {
            $dir = public_path('img/covers');
            if (!file_exists($dir)) mkdir($dir, 0755, true);
            $filename = 'cover_' . uniqid() . '.jpg';
            file_put_contents($dir . '/' . $filename, $imgData);
            $book->update(['image' => asset('img/covers/' . $filename)]);
            $count++;
            echo " -> Saved locally as {$filename}\n";
        } else {
            echo " -> Failed to download (or 404).\n";
        }
    } catch (\Exception $e) {
        echo " -> Error: " . $e->getMessage() . "\n";
    }
}
echo "Done! Updated {$count} books.\n";
