<?php

/* ************************************* */
/* ********** Test Controller ********** */
/* ************************************* */
 
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


/* ******** createCalendarEvent ******** */

try{
  $_POST['email'] = "leon.boddin@tutanota.com";
  $_POST['password'] = "leon123";

  $result = $controller->handleLogin(); 


} catch (Exception $e) {
  echo "Exception: " . $e->getMessage() . '\n'; 
}