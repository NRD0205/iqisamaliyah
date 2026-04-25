<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

try {
    require __DIR__ . '/../vendor/autoload.php';
    echo "Autoload OK!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}