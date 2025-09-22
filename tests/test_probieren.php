<?php

  require_once CORE_PATH . '/repository.php'; 
  require_once CORE_PATH . '/controller.php'; 
  require_once CORE_PATH . '/Database.php';
  
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

  // $existingId = $repo->getEventByDate($event_date);
  // $existingStuff = 1; 

  if(!$existingId && $bool === false){
    echo'ist etwas enthalten '; 
    echo "existingId: $existingId";
  } else {
    echo 'else Zeile';
  }


  echo "The Time is" . date("Y");