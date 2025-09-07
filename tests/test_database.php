<?php

  require_once '../config.php';
  require_once '../src/repository.php'; 
  require_once '../src/core/Database.php';  

  echo "Teste Datenbankverbindung.php \n"; 

  try{
    $connection = Database::getConnection(); 
    

    if($connection instanceof mysqli){
      echo "Datenbankverbindung erfolgreich \n"; 
    } else {
      echo "Fehler: Verbindung ist nicht vom Typ mysqli \n"; 
    }


  } catch (Exception $e) {
    echo "Fehler bei der Verbindung: " . $e->getMessage() . "\n";
  }


/* ************************************* */
/* ********** Test Repository ********** */
/* ************************************* */
  echo "Teste Repository.php \n";
  $calendarRepo = new Repository($connection); 
  $description = "hallo ich bin ein Test-Termin"; 
  $date = "2025-03-25"; 
  $update_id; 
  $update_date = "2025-12-25"; 
  $update_description = "description new"; 

  /* ******** createCalendarEvent ******** */

  try{ 

    $result = $calendarRepo->createCalendarEvent($date, $description);
    $result2 = $calendarRepo->createCalendarEvent($date, $description);
    
    if($result) {
      echo "Event erfolgreich erstellt " . $result ."\n";
      $update_id = $result; 
    } else {
      echo "Fehler: Event wurde nicht erstellt \n";
    }
  } catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . '\n'; 
  }

  /* ******** updateCalendarEvent ******** */
  try{
    $result = $calendarRepo->updateCalendarEvent($update_id, $update_date, $update_description); 
     if($result) {
      echo "Event erfolgreich bearbeitet " . $result . "\n"; 
     } else {
      echo "Fehler: Event wurde nicht bearbeitet \n"; 
     }

  } catch (Exception $e){
    echo "Exception: " . $e->getMessage() . '\n';
  }

  /* ******** deleteCalendarEvent ******** */
  try{
    $result = $calendarRepo->deleteCalendarEvent($update_id); 
    if($result) {
      echo "Event erfolgreich gelöscht " . $result . "\n";  
    } else {
      echo "Fehler: Event wurde nicht gelöscht \n"; 
    }
  } catch (Exception $e){
    echo "Exception: " . $e->getMessage() . '\n';
  }

  /* ********** Test Repository ********** */
  /* ***** getOneMonthCalendarEvents ***** */
  $month = '11'; 
  $year = '2024';
  try{
    $result = $calendarRepo->getOneMonthCalendarEvents($year, $month);
    if($result){
      echo "Event wurden erfolgreich für den Monat: " . $month . " abgerufen \n"; 
      foreach ($result as $index => $event) {
        echo "Index: $index -ID: " . $event['id'] . " - Date: " . $event['event_date'] . " - Description: " . $event['description'] . "\n";
      }
    } else {
      echo "Fehler: Events wurden nicht abgerufen \n"; 
    } 
  } catch (Exception $e){
    echo "Exception: " . $e->getMessage() . '\n'; 
  }





