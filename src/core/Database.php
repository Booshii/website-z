<?php
  
  class Database {
    private static ?mysqli $connection = null;
    private static array $cfg = []; 

    // Private Konstruktor: Verhindert direkte Instanziierung
    private function __construct() {}

    public static function configure(array $config): void {
      self::$cfg = $config['db'] ?? []; 
    }

    public static function getConnection(){
      // prüft ob Verbindung bereits existiert
      if (self::$connection instanceof mysqli){
        return self::$connection;
      }
      $host = self::$cfg['host'] ?? '';
      $user = self::$cfg['user'] ?? 'tim123'; 
      $pass = self::$cfg['pass'] ?? 'tim123my'; 
      $name = self::$cfg['name'] ?? 'website-z'; 

      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 

      try{
        $conn = new mysqli($host, $user, $pass, $name);
        $conn->set_charset('utf8mb4');
        self::$connection = $conn; 
        return self::$connection;
      } catch (Throwable $e){
        error_log('DB_Verbindung fehlgeschlagen: ' . $e->getMessage()); 
        throw new RuntimeException('Datenbankverbindung fehlgeschlagen: '); 
      }
    }

    public static function closeConnection(): void{
      if(self::$connection !== null){
        self::$connection->close(); 
        self::$connection=null; 
      }
    }
  }
?>
