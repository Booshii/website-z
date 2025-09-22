<?php

declare(strict_types=1);

define('BASE_PATH', __DIR__ );
define('PUBLIC_PATH', BASE_PATH . '/public');
define('SRC_PATH', BASE_PATH . '/src');
define('VIEW_PATH', BASE_PATH . '/src/views/');
define('CORE_PATH', BASE_PATH . '/src/core/');

$envFile = BASE_PATH . '/.env';

// Falls eine .env.production existiert, diese bevorzugen
if (file_exists(BASE_PATH . '/.env.production')) {
    $envFile = BASE_PATH . '/.env.production';
}

$env = [];
if (is_file($envFile)) {
    $env = parse_ini_file($envFile, false, INI_SCANNER_TYPED) ?: [];
}

$appDebug = $env['APP_DEBUG'] ?? false;

if ($appDebug) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    ini_set('log_errors', '1');
    error_reporting(E_ALL);
    
    // definiert wo die Logdatein gespeichert werden sollen und erstellt Verzeichnis wenn nicht vorhanden 
    $logDir = BASE_PATH . '/storage/logs';
    if (!is_dir($logDir)){
        // 0750: Berechtigungen, Webserver-User muss Besitzer des Ordners sein
        @mkdir($logDir, 0750, true);
    }
    ini_set('error_log', $logDir . '/php_errors_dev.log');
    
// PROD: nichts anzeigen nur loggen 
} else {
    // nichts anzeigen nur loggen 
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    ini_set('log_errors', '1');
    // Fehler loggen, aber Notices/Deprecations unterdrücken
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
}

$config = [
    'app_name' => 'MeinKalender',
    'default_language' => 'de',
    'base_url' => $env['BASE_URL'] ?? 'http://localhost',
    // Beispiel: DB aus .env
    'db' => [
        'host' => $env['DB_HOST'] ?? '',
        'user' => $env['DB_USER'] ?? 'tim123',
        'pass' => $env['DB_PASS'] ?? 'tim123my',
        'name' => $env['DB_NAME'] ?? 'website-z'
    ]
];