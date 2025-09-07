<?php
  
/* ************************************* */
/* *********** Konfiguration *********** */
/* ************************************* */
  require_once '../config.php';

  // // Session starten
  // if (session_status() === PHP_SESSION_NONE) {
  //     session_start();
  // }

/* ************************************* */
/* ************* Datenbank ************* */
/* ************************************* */

  require_once 'Database.php';

/* ************************************* */
/* ************* App-Klasse ************ */
/* ************************************* */

  class App{
    private $db; // Datenbankverbindung

    public function __construct(){
      $this->initServices(); 
    }

    public function initServices(){
      // Beispiel: Datenbankverbindung oder andere Dienste initialisieren
      // Kann eine Dependency Injection-Logik enthalten
      $this->db = Database::getConnection();
    }

    public function run(){
      require_once 'router.php';
      $router = new Router($this->db); 
      $router->handleRequest(); 
    }

  }
  // App initialisieren und starten 
  $app = new App();
  $app->run(); 
  
?> 

