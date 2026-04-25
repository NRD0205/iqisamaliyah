<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Buat direktori di /tmp
$dirs = [
    '/tmp/framework/cache/data',
    '/tmp/framework/views',
    '/tmp/framework/sessions',
    '/tmp/logs',
    '/tmp/bootstrap/cache',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir))
        mkdir($dir, 0777, true);
}

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath('/tmp');
$app->useBootstrapPath('/tmp/bootstrap');

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);