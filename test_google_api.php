<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$isbn = '0451524934'; // 1984 George Orwell
try {
    $gRes = \Illuminate\Support\Facades\Http::timeout(5)->get("https://www.googleapis.com/books/v1/volumes?q=isbn:{$isbn}");
    if ($gRes->successful()) {
        echo "Google OK!\n";
        print_r($gRes->json());
    } else {
        echo "Google Failed Status: " . $gRes->status() . "\n";
        echo "Response body: " . $gRes->body() . "\n";
    }
} catch (\Exception $e) {
    echo "Exception Caught: " . $e->getMessage() . "\n";
}
