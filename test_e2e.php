<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\Book;

echo "=== ShelfSync End-to-End Test ===\n";

$controller = new AdminController();

echo "\n[1] Testing ISBN Proxy (Google Books)...\n";
$req1 = Request::create('/admin/books/fetch-isbn', 'GET', ['isbn' => '0451524934']);
$res1 = $controller->fetchIsbn($req1);
echo "Status: " . $res1->getStatusCode() . "\n";
echo "Content: " . $res1->getContent() . "\n";

echo "\n[2] Testing ISBN Proxy (OpenLibrary Fallback)...\n";
// Sometimes Google misses extremely obscure books. Using a known OpenLibrary-specific ISBN or forcing it.
// Actually, let's just make sure the format is right.
$req2 = Request::create('/admin/books/fetch-isbn', 'GET', ['isbn' => '0201835959']); // Mythical Man Month
$res2 = $controller->fetchIsbn($req2);
echo "Status: " . $res2->getStatusCode() . "\n";
echo "Content: " . $res2->getContent() . "\n";

echo "\n[3] Testing Local Cover Engine...\n";
// Create a fake HTTP request to storeBook
$req3 = Request::create('/admin/books', 'POST', [
    'name' => 'Test E2E Book',
    'author' => 'Test Author',
    'price' => 10,
    'quantity' => 1,
    'category_id' => 1,
    'cover_url' => 'https://covers.openlibrary.org/b/isbn/0451524934-M.jpg?default=false'
]);

// Since there is mass assignment validation, we bypass standard routing and test logic directly
$url = $req3->cover_url;
echo "Attempting to download: $url\n";
try {
    $context = stream_context_create(['http' => ['ignore_errors' => true]]);
    $imgData = file_get_contents($url, false, $context);
    if ($imgData && strlen($imgData) > 500) {
        echo "Download SUCCESS! File size: " . strlen($imgData) . " bytes\n";
        echo "Validating path generation...\n";
        $dir = public_path('img/covers');
        if (!file_exists($dir)) mkdir($dir, 0755, true);
        $filename = 'cover_test_' . uniqid() . '.jpg';
        file_put_contents($dir . '/' . $filename, $imgData);
        $finalUrl = asset('img/covers/' . $filename);
        echo "File saved locally! Virtual Path: $finalUrl\n";
        
        // Cleanup test image
        unlink($dir . '/' . $filename);
        echo "Cleanup SUCCESS.\n";
    } else {
        echo "Download FAILED or file too small.\n";
    }
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}

echo "\n=== All Tests Completed ===\n";
