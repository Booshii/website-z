<?php

class Repository{
  private $db;

  public function __construct($db) {
      $this->db = $db; 
  }

  //**********************************************/
  //************** Helper Functions **************/
  private function tableForFlat(int $flat): string {
    if (!in_array($flat, [1, 2], true)) {
      throw new InvalidArgumentException("Ungültiger Flat-Wert: $flat");
    }
    return sprintf('`calendar_events_%d`', $flat);
  }
  
  //**********************************************/
  //************** Envent Functions **************/
  //******** create event  ********/
  public function createCalendarEvent(string $date, string $description, int $flat): int|false{
    $table = $this->tableForFlat((int)$flat);
    
    $stmt = $this->db->prepare("INSERT INTO $table (`event_date`, `description`) VALUES (?, ?)");
    if (!$stmt) { 
      throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
    }
    $stmt->bind_param('ss', $date, $description);

    if ($stmt->execute()){
      $insertId = $this->db->insert_id;
      $stmt->close(); 
      return $insertId; 
    } else {
      $stmt->close();
      return false; 
    }
  }

  //******** update event  ********/
  public function updateCalendarEvent(int $id, string $date, string $description, int $flat): int|false {
    $table = $this->tableForFlat((int)$flat);
      
    $stmt = $this->db->prepare("UPDATE $table SET `event_date` = ?, `description` = ? WHERE `id` = ?"); 
    if (!$stmt) { // prepare()-Fehlerbehandlung
      throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
    }
    $stmt->bind_param('ssi', $date, $description, $id); 

    $ok = $stmt->execute();
    $affected_rows = $stmt->affected_rows;
    $stmt->close();

    return $ok ? $affected_rows : false;
  }

  //******** delete event  ********/
  public function deleteCalendarEvent(int $id, int $flat): bool {
    $table = $this->tableForFlat((int)$flat);
      
    $stmt = $this->db->prepare("DELETE FROM $table WHERE `id` = ?");
    if (!$stmt) { // prepare()-Fehlerbehandlung
      throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
    }
    $stmt->bind_param('i', $id);
    
    $ok = $stmt->execute();
    $affected_rows = $stmt->affected_rows;
    $stmt->close();

    return $ok ? $affected_rows : false;
  }

  //******* get event by id *******/
  public function getEventById(int $id, int $flat): ?array {
    $table = $this->tableForFlat((int)$flat);
    
    $stmt = $this->db->prepare("SELECT * FROM $table WHERE `id` = ?");
    if (!$stmt) { 
        throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
    }
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $res->free();
    $stmt->close();
    return $row ?: null;
  }

  //****** get event by date ******/
  public function getEventByDate(string $date, int $flat): ?int {
    $table = $this->tableForFlat((int)$flat);

    $stmt = $this->db->prepare("SELECT `id` FROM $table WHERE `event_date` = ?");
    if (!$stmt) {
      throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
    }
    $stmt ->bind_param('s', $date);
    $stmt->execute();
    
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $res->free();
    $stmt->close();

    return $row['id'] ?? null;
  }

  //**** get events one month  ****/
  public function getOneMonthCalendarEvents(int $year, int $month, int $flat): array{    
    $table = $this->tableForFlat((int)$flat);
    $year  = (int)$year;
    $month = (int)$month;
    if ($year < 1970 || $year > 2100) {
      throw new InvalidArgumentException("Ungültiges Jahr: $year");
    }
    if ($month < 1 || $month > 12) {
      throw new InvalidArgumentException("Ungültiger Monat: $month");
    }
    // range filter for a search with additional INDEX (idx_calendar_events_1_event_date)
    $start = sprintf('%04d-%02d-01', $year, $month);
    $end = date('Y-m-d', strtotime("$start +1 month"));
    $stmt = $this->db->prepare("SELECT `id`, `event_date`, `description`
                                FROM $table
                                WHERE `event_date` >= ? AND `event_date` < ?
                                ORDER BY `event_date` ASC"); 
    if (!$stmt) {
      throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
    }            
    $stmt->bind_param('ss', $start, $end); 
    $stmt->execute();
    
    $res = $stmt->get_result();
    $events = $res->fetch_all(MYSQLI_ASSOC); 
    $res->free();
    $stmt->close(); 

    return $events; 
  }
  //******* get all events ********/
  public function getAllEvents(int $flat): array {
    $table = $this->tableForFlat((int)$flat);
    $stmt = $this->db->query("SELECT `id`, `event_date`, `description` FROM $table 
                              ORDER BY `event_date` ASC");
    if (!$stmt) {
      throw new Exception("Fehler bei der Abfrage: " . $this->db->error);
    } 
    $result = $stmt->fetch_all(MYSQLI_ASSOC);
    $stmt->free(); 
    return $result; 
  }

  //**********************************************/
  //************** Login Functions ***************/
  public function getUserByEmail(string $email): ?array {
    $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = ?"); 
    if(!$stmt){
        throw new Exception("Error while prepare statement: " . $this->db->error);          
    }
    $stmt->bind_param("s", $email); 
    $stmt->execute(); 

    $result = $stmt->get_result(); 
    $user = $result->fetch_assoc(); 
    $result->free();
    $stmt->close();

    return $user ?: null; 
  }
  public function getUserByUsername(string $username): ?array {
    $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `username` = ?");
    if (!$stmt) {
      throw new Exception("Error while prepare statement: " . $this->db->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $result->free();
    $stmt->close();
    return $user ?: null;
  }
}
  
    
