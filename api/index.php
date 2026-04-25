<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

try {
    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->useStoragePath('/tmp');

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $request = Illuminate\Http\Request::capture();
    echo "Request OK!<br>";

    $response = $kernel->handle($request);
    echo "Handle OK!<br>";

    $response->send();
    $kernel->terminate($request, $response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} catch (Error $e) {
    echo "Fatal Error: " . $e->getMessage();
}