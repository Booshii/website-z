<?php

/* ************************************* */
/* *********** Konfiguration *********** */
/* ************************************* */

  // Fehlerberichterstattung 
  ini_set('display_errors', 1); 
  error_reporting(E_ALL); 
  
  // Datenbank-Konfigurationen 
  define('DB_HOST', 'localhost'); 
  define('DB_NAME', 'website-z'); 
  define('DB_USER', 'tim123'); 
  define('DB_PASS', 'tim123my');

  // Basis-URL (optional, für spätere Verwendung)
  define('BASE_URL', __DIR__ );
  define('PUBLIC_URL', BASE_URL . '/public');
  define('SRC_URL', BASE_URL . '/src');
  define('VIEW_URL', BASE_URL . '/src/views/');
  define('CORE_URL', BASE_URL . '/src/core/');