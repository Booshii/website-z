<?php

  require_once __DIR__ . '/../../config.php';
  
  class Database {
    private static $connection = null; 

    // Private Konstruktor: Verhindert direkte Instanziierung
    private function __construct() {}

    public static function getConnection(){
      // prüft ob Verbindung bereits existiert
      if (self::$connection === null){
        try{
          self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
          if (self::$connection->connect_error) {
            throw new Exception('Datenbankverbindung fehlgeschlagen: ' . self::$connection->connect_error);
          }
        } catch (Exception $e){
          error_log($e->getMessage()); 
          throw new Exception('Datenbankverbindung fehlgeschlagen: '); 
        }
        return self::$connection;
      }
      return self::$connection;
    }

    public static function closeConnection(){
      if(self::$connection !== null){
        self::$connection->close(); 
        self::$connection=null; 
      }
    }
  }
?>
