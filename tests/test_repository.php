<?php

  require_once '../src/core/controller.php';
  require_once '../src/core/Database.php';
  require_once '../src/core/repository.php'; 

  echo "start \n";

  $envFilePath = '../.env';

  $env = parse_ini_file($envFilePath, false, INI_SCANNER_TYPED);
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


  // Datum und Flat 
  $date = '2026-01-02';
  $flat = 1; 

  $db;
  Database::configure($config);
  $db = Database::getConnection();

  $repository = new Repository($db);
  $existingId = $repository->getEventByDate($date, $flat);
  print_r($existingId);
  print($existingId['id']);