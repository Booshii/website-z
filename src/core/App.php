<?php
// ===================================================
// HEAD-REQUEST: buffer Output, that no body is
// send to the client (only Header & Status)
// ===================================================
  if ($_SERVER['REQUEST_METHOD'] === 'HEAD') {
      ob_start();
  }

/* ************************************* */
/* ************* Datenbank ************* */
/* ************************************* */

  require_once CORE_PATH . '/Database.php';

/* ************************************* */
/* ************* App-Klasse ************ */
/* ************************************* */

  class App{
    private mysqli $db; // Datenbankverbindng
    private array $config; 

    public function __construct(array $config){
      $this->config = $config; 
      $this->initServices(); 
    }
    public function initServices(): void {
      Database::configure($this->config);
      $this->db = Database::getConnection();
    }

    public function run(): void{
      require_once CORE_PATH . 'router.php';
      $router = new Router($this->db, $this->config); 
      $router->handleRequest(); 
    }

  }
  // App initialisieren und starten 
  $app = new App($config);
  $app->run(); 

// ===================================================
// HEAD-REQUEST: throw buffered output,
// Header & Status be preserved
// ===================================================
  if ($_SERVER['REQUEST_METHOD'] === 'HEAD') {
      ob_end_clean();
  }
  
?> 

