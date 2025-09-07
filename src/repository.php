<?php

error_reporting(E_ALL);
                    ini_set('display_errors', 1);


    class Repository{
        private $db;

        public function __construct($db) {
            $this->db = $db; 
        }

        // Event erstellen 
        public function createCalendarEvent($date, $description, $flat){
            // $query = 'INSERT INTO calendar_events (date, description) VALUES (:date, :description)'; 
            $flat = (int)$flat;
            if (!in_array($flat, [1, 2], true)){
              throw new InvalidArgumentException("Ungültiger Flat-Wert: $flat");
            }

            $table = "calendar_events_" . $flat;
						
						$stmt = $this->db->prepare("INSERT INTO $table (date, description) VALUES (?, ?)");
            $stmt->bind_param('ss', $date, $description);

            if($stmt->execute()){
                return $this->db->insert_id; 
            } else {
                return false; 
            }

        }

        //****** Event aktualisieren  ******/
        public function updateCalendarEvent($id, $date, $description, $flat) {
            
					$flat = (int)$flat;
					if (!in_array($flat, [1, 2], true)){
						throw new InvalidArgumentException("Ungültiger Flat-Wert: $flat");
					}
					$table = "calendar_events_" . $flat;
						
					$stmt = $this->db->prepare("UPDATE $table SET date = ?, description = ? WHERE id = ?"); 
          $stmt->bind_param('ssi', $date, $description, $id); 
            
          if($stmt->execute()){
              return $stmt->affected_rows; 
          } else {
              return false; 
					}
        }

        //****** Event löschen  ******/
        public function deleteCalendarEvent($id, $flat) {
					$flat = (int)$flat;
					if (!in_array($flat, [1, 2], true)){
						throw new InvalidArgumentException("Ungültiger Flat-Wert: $flat");
					}
					$table = "calendar_events_" . $flat;
						
					$stmt = $this->db->prepare("DELETE FROM $table WHERE id = ?");
					$stmt->bind_param('i', $id);
					
					if($stmt->execute()){
							return $stmt->affected_rows; 
					} else {
							return false; 
					}
        }

        //****** Event nach ID abrufen   ******/
        public function getEventById($id, $flat) {
					$flat = (int)$flat;
					if (!in_array($flat, [1, 2], true)){
						throw new InvalidArgumentException("Ungültiger Flat-Wert: $flat");
					}
					$table = "calendar_events_" . $flat;
					
					$stmt = $this->db->prepare("SELECT * FROM $table WHERE id = ?");
					$stmt->bind_param('i', $id);
					$stmt->execute();
					// holt sich die Antwort und speichert es in ein assoziatives Array 
					// fetch_assoc() holt nur eine Zeile 
					return $stmt->get_result()->fetch_assoc();
        }

        //****  Event nach Datum abrufen 
        public function getEventByDate($date, $flat) {
					$flat = (int)$flat;
					if (!in_array($flat, [1, 2], true)){
						throw new InvalidArgumentException("Ungültiger Flat-Wert: $flat");
					}
					$table = "calendar_events_" . $flat;

					$stmt = $this->db->prepare("SELECT id FROM $table WHERE date = ?");
					$stmt ->bind_param('s', $date);
					$stmt->execute();
					$result = $stmt->get_result();
					$row = $result->fetch_assoc();
					// wenn row mit [id] vorhanden dann wird es zurückgegeben sonst null
					return $row['id'] ?? null;
        }

        // Events von einem Monat nach Datum sortiert?
        public function getOneMonthCalendarEvents($year, $month, $flat){
            // fange an hier Sicherheitschecks einzubauen 
            // muss noch erweitert werden 
						// passiert immer fehler dass falsche daten in den Link geworfen werden 
						// vllt gucken dass Monat immer zwischen 1-12 ist und ne zahl sowie Jahre auf in testen
            
            // für flat 
            $flat = (int)$flat;
            if (!in_array($flat, [1, 2], true)){
              throw new InvalidArgumentException("Ungültiger Flat-Wert: $flat");
            }

            $table = "calendar_events_" . $flat;
            
            $stmt = $this->db->prepare("SELECT id, DATE AS event_date, description
                                        FROM $table
                                        WHERE YEAR(date) = ? AND MONTH(date) = ? ORDER BY date ASC"); 
             if (!$stmt) {
                throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);
            }            
            
            $stmt->bind_param('ii', $year, $month); 
            $stmt->execute(); 
            $result = $stmt->get_result(); 
            $events = []; 

            while ($row = $result->fetch_assoc()) {
                $events[] = $row; 
            }
            $stmt->close(); 

            return $events; 
        }
        // Alle Events abrufen
        public function getAllEvents($flat) {
          $flat = (int)$flat;
					if (!in_array($flat, [1, 2], true)){
						throw new InvalidArgumentException("Ungültiger Flat-Wert: $flat");
					}
					$table = "calendar_events_" . $flat;

					$stmt = $this->db->query("SELECT * FROM $table ORDER BY date ASC");
					// holt alle Zeilen und gibt die als Array von Arrays zurück 
					$result = $stmt->fetch_all(MYSQLI_ASSOC);
					$stmt->close(); 
					return $result; 
        }

        //**********************************************/
        //************** Login Funktionen **************/

        public function getUserByEmail(string $email): ?array {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?"); 
            
            if(!$stmt){
                throw new Exception("Fehler beim Vorbereiten des Statements: " . $this->db->error);          
            }

            $stmt->bind_param("s", $email); 
            $stmt->execute(); 

            $result = $stmt->get_result(); 
            $user = $result->fetch_assoc(); 

            $stmt->close();

            return $user ? $user : null; 

        }




    }
        
