<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

try {
    define('LARAVEL_START', microtime(true));

    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Override storage DAN cache ke /tmp
    $app->useStoragePath('/tmp');
    $app->instance('path.bootstrap', '/tmp');

    // Buat direktori yang dibutuhkan di /tmp
    $dirs = [
        '/tmp/cache',
        '/tmp/views',
        '/tmp/sessions',
        '/tmp/framework',
        '/tmp/framework/cache',
        '/tmp/framework/views',
        '/tmp/framework/sessions',
        '/tmp/logs',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir))
            mkdir($dir, 0777, true);
    }

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $request = Illuminate\Http\Request::capture();
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} catch (Error $e) {
    echo "Fatal Error: " . $e->getMessage();
}