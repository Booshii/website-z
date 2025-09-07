<?php
      error_reporting(E_ALL);
    ini_set('display_errors', 1);

  require_once 'repository.php'; 

  class Controller {
      
    private $repository; 
    
    public function __construct($db) {
        $this->repository = new Repository($db); 
    }

  //**********************************************/
  //************ Dashboard Funktionen ************/

      // erstmal nur für das Aufrufen der Seite
      public function renderDashboard($displayed_month, $displayed_year, $displayed_flat){
        // session hier überhaupt nötig da es ja da sein müsste wenn diese Funktion aufgerufen wird

        // Variablen die in der dashboard.php benötigt werden 
        $current_month = $displayed_month;
        $current_year = $displayed_year;
        $current_flat = $displayed_flat;

        $calendar_events = $this->repository->getOneMonthCalendarEvents($displayed_year, $displayed_month, $displayed_flat);
        

        //*** Logik wenn man mehr mit Sessions arbetien will um Datenbank zugriffe zu reduzieren ***
        //**************************************************************************************** */

        // die ursprünglichen Daten speichern wenn sie nicht schon vorhanden sind ? 
        // if (!isset($_SESSION['original_calendar_events'])) {
        //   $calendar_events = $this->repository->getOneMonthCalendarEvents($current_year, $current_month);
        //   $_SESSION['original_calendar_events'] = $calendar_events; 
        // }

        // // wenn Daten vorhanden in $calendar_events speichern 
        // $calendar_events = $_SESSION['original_calendar_events'];
        
        include VIEW_URL . 'dashboard.php'; 
      }
      
      public function handleFormRequest() {
        
        // Guard clause: invalid REQUEST_METHOD
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
          echo json_encode(['error' => 'Ungültige Anfragemethode']); 
          return;
        }
      
        // Ursprüngliche Daten aus der Session abrufen
        // $original_calendar_events = $_SESSION['original_calendar_events'] ?? [];
        // Prüft, welches Formular abgesendet wurde
        $formType = $_POST['submit_button'] ?? ''; 

        switch ($formType) {
          //****** Dashboard Form ******/
          case 'save_events': 
            
            $flat = $_POST['submited_flat'];

            foreach ($_POST['dates'] as $date) {
              $status = $_POST['select_status'][$date] ?? null;
              $description = $_POST['description'][$date] ?? '';

              $existingId = $this->repository->getEventByDate($date, $flat);
              echo "date: $date ,description $description ,existingId: $existingId ,status: $status<br>"; 
              echo gettype($status);
              if(!$existingId && $status === "true"){
                // nichts passiert
                continue;
              } elseif ($existingId == null && $status === "false") {
                // Event wird eingetragen
                $this->repository->createCalendarEvent($date, $description, $flat);
              } elseif ($existingId && $status === "false"){
                // Event wird bearbeitet
                $this->repository->updateCalendarEvent($existingId, $date, $description, $flat);
              } elseif ($existingId && $status === "true"){
                // Event löschen
                $this->repository->deleteCalendarEvent($existingId, $flat);
              } else {
                error_log("Fehler beim Verarbeiten von Datum $date");
                echo "Keine Änderung festgestellt oder unbekannter Fall bei Datum: $date<br>";
              }
            };


            // get month and year for redirect 
            $firstDate = $_POST['dates'][0] ?? date('Y-m-d');
            $year  = date('Y', strtotime($firstDate));
            $month = date('n', strtotime($firstDate));

            header("Location: /dashboard?month={$month}&year={$year}&flat={$flat}", true);
            exit(); 
            break;

          //****** Login Form ******/
          case 'user_login': 
            if (isset($_POST['email'], $_POST['password'])) {
              $this->handleLogin(); 
            } else {
              echo json_encode(['error' => 'Fehler beim Login']);
            }; 
            
            break;
        }
      }


      // kann eigentlich weg 
      // public function createEventForm($date, $description) {
      //   $result = $this-repository->createCalendarEvent($date, $description); 
        
      //   if($result) {
      //     header("Location: /dashboard"); 
      //     exit();
      //   } else {
      //     echo "<p>Fehler beim Erstellen des Termins!</p>";
      //   }
      // }

  //**********************************************/
  //************** Login Funktionen **************/

      //Login
      public function renderLogin($errors = []){
        // was macht errors
        require_once VIEW_URL . '/login.php'; 
      }

      public function handleLogin(){

        $errors = []; 

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
        $email = trim($email); 

        $password = filter_input(INPUT_POST, 'password'); 
      

        if (!$email) {
          $errors[] = "Bitte E-Mail eingeben.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors[] = "Ungültiges E-Mail-Format.";
        }

        if (empty($password)) {
          $errors[] = "Bitte Passwort eingeben.";
        }

        if (!empty($errors)) {
          $this->renderLogin($errors);
          return;
        }

        // get User from database from the repository
        // compare password with input 

        $user_database = $this->repository->getUserByEmail($email); 
        // echo "<pre>"; 
        //   print_r($user_database); 
        //   print_r(password_hash($password,PASSWORD_DEFAULT)); 
        // echo "</pre>"; 

        //prüfen ob user leer 
        // if (empty($user_database))

        if(!$user_database || !password_verify($password, $user_database['password_hash'])) {
          $errors[] = "Ungültige Login-Daten. "; 
          $this->renderLogin($errors); 
          return; 
        }
        
        if(session_status() === PHP_SESSION_NONE){
          session_start();
        }
        // Session speichern un weiterleiten zum dashboard
        $_SESSION['user_id'] = $user_database['id'];
        header("Location: /dashboard", true); 
        exit();
      }



      }