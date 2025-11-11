<?php

require_once 'repository.php'; 

class Controller {
    
  private $repository; 
  private $config; 
  
  public function __construct(mysqli $db, array $config) {
    $this->repository = new Repository($db); 
    $this->config = $config; 
  }

  //**********************************************/
  //************* Helper Functions ***************/
  //**********************************************/
  public function assertValidFlat(int $flat): void {
    if (!in_array($flat, [1, 2], true)) {
      http_response_code(404);
      echo 'Unbekannte Ferienwohnung.';
      exit();
    }
  }

  //**********************************************/
  //************** Fewo Functions ****************/
  //**********************************************/
  public function renderFeWo(int $flat): void {
    $this->assertValidFlat($flat);
    
    $current_month = date("m");
    $current_year = date("Y");

    $config = $this->config;
    $displayed_flat = $flat; 
    $calendar_events = $this->repository->getOneMonthCalendarEvents($current_year, $current_month, $flat);

    if((int)$flat == 1){
      require_once VIEW_PATH . '/fewo1.php';
    } else {
      require_once VIEW_PATH . '/fewo2.php';
    }
  }

  //**********************************************/
  //************ Dashboard Functions *************/
  //**********************************************/
  public function renderDashboard(int $displayed_month, int $displayed_year, int $flat): void {

    $config = $this->config;
    $displayed_flat = $flat; 
    $calendar_events = $this->repository->getOneMonthCalendarEvents($displayed_year, $displayed_month, $displayed_flat);

    include VIEW_PATH . 'dashboard.php'; 
  }
  
  public function handleFormRequest(): void {
    // Guard clause: invalid REQUEST_METHOD
    if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
      echo json_encode(['error' => 'Ungültige Anfragemethode']); 
      return;
    }        
    $flat = $_POST['submited_flat'];

    foreach ($_POST['dates'] as $date) {
      $status = $_POST['select_status'][$date] ?? null;
      $description = $_POST['description'][$date] ?? '';
      $existingId = $this->repository->getEventByDate($date, $flat);
      echo "date: $date ,description $description ,existingId: $existingId ,status: $status<br>"; 
      echo gettype($status);
      if(!$existingId && $status === "true"){
        // nothing happens
        continue;
      } elseif ($existingId == null && $status === "false") {
        // CREATE
        $this->repository->createCalendarEvent($date, $description, $flat);
      } elseif ($existingId && $status === "false"){
        // UPDATE
        $this->repository->updateCalendarEvent($existingId, $date, $description, $flat);
      } elseif ($existingId && $status === "true"){
        // DELETE
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
  }

//**********************************************/
//************** Login Functions ***************/
//**********************************************/
  public function renderLogin(array $errors = [], string $oldEmail = ''): void{
    require VIEW_PATH . '/login.php'; 
  }

  public function handleLogin(): void {
     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      echo 'Ungültige Anfragemethode.';
      return;
    }

    $errors = []; 
    $emailRaw = $_POST['email'] ?? '';
    $passwordRaw = $_POST['password'] ?? '';
    $email = trim((string)$emailRaw); 
    $password = (string)$passwordRaw;
  
    if ($email === '') {
      $errors[] = "Bitte E-Mail eingeben.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Ungültiges E-Mail-Format.";
    }
    
    if ($password === '') {
      $errors[] = "Bitte Passwort eingeben.";
    }

    if ($errors) {
      $this->renderLogin($errors, $email);
      return;
    }

    $user_database = $this->repository->getUserByEmail($email); 

    if(!$user_database || !password_verify($password, $user_database['pwd'])) {
      $errors[] = "Ungültige Login-Daten. "; 
      $this->renderLogin($errors, $email); 
      return; 
    }
    
    if(session_status() === PHP_SESSION_NONE){
      session_start();
    }
    
    session_regenerate_id(true);
    
    $_SESSION['user_id'] = $user_database['id'];
    header("Location: /dashboard", true); 
    exit();
  }

//********************************************/
//************** API Functions ***************/
//********************************************/
  public function handleApiRequest(int $year, int $month, int $flat): void {
    header('Content-Type: text/html; charset=utf-8');
    try {
      $events = $this->repository->getOneMonthCalendarEvents($year, $month, $flat);
      require_once SRC_PATH . '/templates/calendar.php';
      $html = renderCalendar($month, $year, $events);
      echo $html;

    } catch (Throwable $e){
      http_response_code(500);
      echo '<!-- Internal Server Error -->';
    }
  }
}