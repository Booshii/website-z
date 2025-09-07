<?php

  error_reporting(E_ALL);
  ini_set('display_errors', 1);


  require_once '../src/repository.php'; 
  require_once '../src/controller.php'; 
  require_once '../src/core/Database.php';
  
  try {
  $connection = Database::getConnection(); 

    if($connection instanceof mysqli){
      echo "Datenbankverbindung erfolgreich \n"; 
    } else {
      echo "Fehler: Verbindung ist nicht vom Typ mysqli \n"; 
    }
  } catch (Exception $e) {
    echo "Fehler bei der Verbindung: " . $e->getMessage() . "\n";
  }



echo "Teste Controller.php \n"; 
$repo = new Repository($connection); 
$controller = new Controller($connection);

  $date = '2025-03-26';
  $bool = false; 

  $existingId = $repo->getEventByDate($date);
  $existingStuff = 1; 

  if(!$existingId && $bool === false){
    echo'ist etwas enthalten '; 
    echo "existingId: $existingId";
  } else {
    echo 'else Zeile';
  }


  echo "The Time is" . date("Y");