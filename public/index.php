<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    require_once dirname(__DIR__) . '/vendor/autoload.php';

    require_once dirname(__DIR__) . '/app/core/Database.php';

    $router = require_once __DIR__ . '/../config/routes.php';

    $url = $_SERVER['REQUEST_URI'];
    
    $router->dispatch($url);
    
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
