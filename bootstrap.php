<?php

declare(strict_types=1);

define('BASE_PATH', __DIR__ );
define('PUBLIC_PATH', BASE_PATH . '/public');
define('SRC_PATH', BASE_PATH . '/src');
define('VIEW_PATH', BASE_PATH . '/src/views/');
define('CORE_PATH', BASE_PATH . '/src/core/');
define('TEMPLATE_PATH', BASE_PATH . '/src/templates/');


//**********************************************/
//****** Error - / Exception - Logging  ********/
//**********************************************/


error_reporting(E_ALL);
ini_set('log_errors', '1');


function appErrorHandler($errno, $errstr, $errfile, $errline): bool {
  $message = "[PHP Error][$errno] $errstr in $errfile:$errline";
  error_log($message);

  if (ini_get('display_errors')) {
    echo "<b>Fehler:</b>" . htmlspecialchars($errstr) . 
    " in " . htmlspecialchars($errfile) . ":" . (int)$errline; 
  }
  return true; 
}

function appExceptionHandler(Throwable $e): void {
  $message = "[Exception] " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine();
  error_log($message);

  if (ini_get('display_errors')) {
    echo "<b>Exception:</b> " . htmlspecialchars($e->getMessage()) . "<br>";
  } else {
        http_response_code(500);
        echo "<h1>Application error</h1>";
    }
}

function appShutdownHandler(): void {
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
//******** App Configuration env. file  ********/
//**********************************************/

$envFilePath = BASE_PATH . '/.env';

// Falls eine .env.production existiert, diese bevorzugen
// if (file_exists(BASE_PATH . '/.env.production')) {
// 	$envFile = BASE_PATH . '/.env.production';
// }
if (!is_file($envFilePath) || !is_readable($envFilePath)) {
  throw new RuntimeException(".env missing oder not readable");
}

$env = parse_ini_file($envFilePath, false, INI_SCANNER_TYPED);

if ($env === false) {
	throw new RuntimeException((".env is invalid"));
}
//**********************************************/
//********** DEBUG Configuration ***************/
//**********************************************/

$appDebug = $env['APP_DEBUG'] ?? false;

if ($appDebug) {
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
} else {
	ini_set('display_errors', '0');
	ini_set('display_startup_errors', '0');
}

//**********************************************/
//*********** App Configuration ****************/
//**********************************************/
$config = [
	'app_name' => 'MeinKalender',
	'default_language' => 'de',
	'base_url' => $env['BASE_URL'] ?? 'http://localhost',

	'db' => [
		'host' => $env['DB_HOST'] ?? 'localhost',
    'port' => (int)($env['DB_PORT'] ?? 3306),
		'user' => $env['DB_USER'] ?? '',
		'pass' => $env['DB_PASS'] ?? '',
		'name' => $env['DB_NAME'] ?? ''
  ],
  'session' => [
    'name' => $env['SESSION_NAME'],
    'cookie_lifetime' => $env['COOKIE_LIFETIME'],
    'cookie_secure' => $env['COOKIE_SECURE'],
    'cookie_httponly' => $env['COOKIE_HTTPONLY'],
    'cookie_samesite' => $env['COOKIE_SAMESITE'],
  ],
];

