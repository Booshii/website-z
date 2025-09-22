<?php

class Repository{
  private $db;

  public function __construct($db) {
      $this->db = $db; 
  }

  // Helper für den richtigen Tablenamen
  private function tableForFlat(int $flat): string {
    if (!in_array($flat, [1, 2], true)) {
      throw new InvalidArgumentException("Ungültiger Flat-Wert: $flat");
    }
    return sprintf('`calendar_events_%d`', $flat);
  }

  // Event erstellen 
  public function createCalendarEvent($date, $description, $flat){
    $table = $this->tableForFlat((int)$flat);
    
    $stmt = $this->db->prepare("INSERT INTO $table (`event_date`, `description`) VALUES (?, ?)");
    if (!$stmt) { // prepare()-Fehlerbehandlung
      throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
    }
    $stmt->bind_param('ss', $date, $description);

    if ($stmt->execute()){
      $insertId = $this->db->insert_id;
      $stmt->close(); // korrekt schließen
      return $insertId; 
    } else {
      $stmt->close();
      return false; 
    }
  }

  //****** Event aktualisieren  ******/
  public function updateCalendarEvent($id, $date, $description, $flat) {
    $table = $this->tableForFlat((int)$flat);
      
    $stmt = $this->db->prepare("UPDATE $table SET `event_date` = ?, `description` = ? WHERE `id` = ?"); 
    if (!$stmt) { // prepare()-Fehlerbehandlung
      throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
    }
    $stmt->bind_param('ssi', $date, $description, $id); 

    $affected_rows = $stmt->affected_rows;
    $ok = $stmt->execute();
    $stmt->close();

    return $ok ? $affected_rows : false;
  }

  //****** Event löschen  ******/
  public function deleteCalendarEvent($id, $flat) {
    $table = $this->tableForFlat((int)$flat);
      
    $stmt = $this->db->prepare("DELETE FROM $table WHERE `id` = ?");
    if (!$stmt) { // prepare()-Fehlerbehandlung
      throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
    }
    $stmt->bind_param('i', $id);
    
    $affected_rows = $stmt->affected_rows;
    $ok = $stmt->execute();
    $stmt->close();

    return $ok ? $affected_rows : false;
  }

  //****** Event nach ID abrufen   ******/
  public function getEventById($id, $flat) {
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
    return $row;
  }

  //****  Event nach Datum abrufen 
  public function getEventByDate($date, $flat) {
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

    // wenn row mit [id] vorhanden dann wird es zurückgegeben sonst null
    return $row['id'] ?? null;
  }

  // Events von einem Monat nach Datum sortiert?
  public function getOneMonthCalendarEvents($year, $month, $flat){    
    $table = $this->tableForFlat((int)$flat);
    // Validierung der parameter
    $year  = (int)$year;
    $month = (int)$month;
    if ($year < 1970 || $year > 2100) {
      throw new InvalidArgumentException("Ungültiges Jahr: $year");
    }
    if ($month < 1 || $month > 12) {
      throw new InvalidArgumentException("Ungültiger Monat: $month");
    }
    // Rangefilter für die Suche mit dem zusätzlichen INDEX (idx_calendar_events_1_event_date)
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

  // Alle Events abrufen
  public function getAllEvents($flat) {
    $table = $this->tableForFlat((int)$flat);
    // hier kommt C10 
    $stmt = $this->db->query("SELECT `id`, `event_date`, `description` FROM $table 
                              ORDER BY `event_date` ASC");
    if (!$stmt) {
      throw new Exception("Fehler bei der Abfrage: " . $this->db->error);
    } 
    // holt alle Zeilen und gibt die als Array von Arrays zurück 
    $result = $stmt->fetch_all(MYSQLI_ASSOC);
    $stmt->free(); 
    return $result; 
  }

  //**********************************************/
  //************** Login Funktionen **************/

  public function getUserByEmail(string $email): ?array {
      $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = ?"); 
      if(!$stmt){
          throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);          
      }
      $stmt->bind_param("s", $email); 
      $stmt->execute(); 

      $result = $stmt->get_result(); 
      $user = $result->fetch_assoc(); 
      $result->free();
      $stmt->close();

      return $user ?: null; 
  }
}
    
