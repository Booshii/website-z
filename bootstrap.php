<?php

declare(strict_types=1);

define('BASE_PATH', __DIR__ );
define('PUBLIC_PATH', BASE_PATH . '/public');
define('SRC_PATH', BASE_PATH . '/src');
define('VIEW_PATH', BASE_PATH . '/src/views/');
define('CORE_PATH', BASE_PATH . '/src/core/');
define('TEMPLATE_PATH', BASE_PATH . '/src/templates/');

$envFile = BASE_PATH . '/.env';

// Falls eine .env.production existiert, diese bevorzugen
if (file_exists(BASE_PATH . '/.env.production')) {
	$envFile = BASE_PATH . '/.env.production';
}

$env = [];
if (is_file($envFile)) {
	$env = parse_ini_file($envFile, false, INI_SCANNER_TYPED) ?: [];
}

//**********************************************/
//****** Error - / Exception - Logging  ********/
//**********************************************/

$appDebug = $env['APP_DEBUG'] ?? false;

error_reporting(E_ALL);
ini_set('log_errors', '1');


if ($appDebug) {
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
} else {
	ini_set('display_errors', '0');
	ini_set('display_startup_errors', '0');
}


function appErrorHandler($errno, $errstr, $errfile, $errline) {
  $message = "[PHP Error][$errno] $errstr in $errfile:$errline";
  error_log($message);

  if (ini_get('display_errors')) {
    echo "<b>Fehler:</b> $errstr in $errfile:$errline"; 
  }
  return true; 
}

function appExceptionHandler(Throwable $e) {
  $message = "[Exception] " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine();
  error_log($message);

  if (ini_get('display_errors')) {
    echo "<b>Exception:</b> " . $e->getMessage() . "<br>";
  }
}

function appShutdownHandler() {
  $error = error_get_last();
  if ($error !== null) {
    $message = "[FATAL][{$error['type']}] {$error['message']} in {$error['file']}:{$error['line']}";
    error_log($message);
  }
}

// register Handler
set_error_handler('appErrorHandler');
set_exception_handler('appExceptionHandler');
register_shutdown_function('appShutdownHandler');

//**********************************************/
//*********** App Configuration ****************/
//**********************************************/
$config = [
	'app_name' => 'MeinKalender',
	'default_language' => 'de',
	'base_url' => $env['BASE_URL'] ?? 'http://localhost',

	'db' => [
		'host' => $env['DB_HOST'] ?? '',
		'user' => $env['DB_USER'] ?? 'tim123',
		'pass' => $env['DB_PASS'] ?? 'tim123my',
		'name' => $env['DB_NAME'] ?? 'website-z'
	]
];