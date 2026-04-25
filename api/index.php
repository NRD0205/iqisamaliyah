<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

try {
    require __DIR__ . '/../vendor/autoload.php';
    echo "Autoload OK!<br>";

    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "Bootstrap OK!<br>";

    $app->useStoragePath('/tmp');

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "Kernel OK!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}