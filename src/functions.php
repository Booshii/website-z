<?php
    /**
     * Funktionen: 
     * - getOneMonthCalendarEvents
     * - getCalendarEventsForDashboard
     * - addCalendarEvent
     * - processFormSubmission
     * sind alles Datenbank funktionen 
     * login hat eine eigene Datei
     * könnte auch der Controller sein? 
     * 
     * 
     */
    require_once 'core/Database.php';

    //function getCalendarEventsOnlyMonthAndDate
    //function getCalendarEvent

    // vielleicht noch mit jahr ausgeben 
    // später beim erstellen gucken ob der Rückgabewert leer ist dann kann man sich die Itteration dadurch sparen


    // 16.09 currentMonth wird nicht verwendet



    function getOneMonthCalendarEvents($month, $year){
        $conn = Database::getConnection();
        // $currentMonth = (int)date('n'); 
        
        // $result = $conn->query("SELECT id, DATE_FORMAT(date, '%d-%m-%Y') AS formated_date, description 
        //                         FROM calendar_events 
        //                         WHERE (YEAR(date) = YEAR(CURDATE()) 
        //                           AND MONTH(date) = MONTH(CURDATE()))
        //                         ORDER BY date ASC ");
        // $events = $result->fetch_all(MYSQLI_ASSOC);
        // bereite das SQL Statement vor
        $stmt = $conn->prepare("SELECT id, DATE_FORMAT(date, '%d-%m-%Y') AS event_date, description 
                                FROM calendar_events 
                                WHERE YEAR(date) = ? 
                                  AND MONTH(date) = ?
                                ORDER BY date ASC");

        // Binde die parameter an das Statement
        $stmt->bind_param("ii", $year, $month);

        // Führe Statement aus 
        $stmt->execute(); 
        // Ergebnisse holen 
        $result = $stmt->get_result(); 
        $events = $result->fetch_all(MYSQLI_ASSOC);

        // schließe Statement und die Verbindung 
        $stmt->close(); 

        // Das vorbereitete Statement (Prepared Statement) ist nicht 
        // ganz so kompakt, weil es zusätzliche Schritte für die Sicherheit 
        // und Zuverlässigkeit der Datenbankoperationen einführt. 
        // Die Verwendung von prepare(), bind_param(), und execute() ist 
        // notwendig, um SQL-Injection zu verhindern 
        // und die Variablen sicher in die Abfrage einzubinden.



        return $events; 
    }

    // function getCalendarEventsForDashboard(){
    //     $conn = Database::getConnection(); 
    //     // prüft ob es einen Fehler bei der Connection gab 
    //     // if ($conn->connect_error) {
    //     //     die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
    //     // }
    //     $currentMonth = (int)date('n'); 

    //     // eine SQL-Abfrage ausführen, um alle Einträge aus der Tabelle 'calendar_events' auszuwählen,
    //     // und die Ergebnisse nach dem Datum aufsteigend zu sortieren - ASC = ascending - aufsteigend
    //     $result = $conn->query("SELECT id, DATE_FORMAT(date, '%d-%m-%Y') AS formated_date, description 
    //                             FROM calendar_events 
    //                             WHERE (YEAR(date) = YEAR(CURDATE()) AND MONTH(date) BETWEEN MONTH(CURDATE()) - 1 AND MONTH(CURDATE()) + 4) 
    //                             OR    (YEAR(date) = YEAR(CURDATE()) + 1 AND MONTH(date) <= MONTH(CURDATE()) - 8)
    //                             ORDER BY date ASC ");
        
    //     // prüft ob es einen Fehler im SQL gab
    //     // if (!$result) {
    //     //     die("Fehler in der SQL-Abfrage: " . $conn->error);
    //     // }  

        
    //     // Ergebnisse in assoziativen Array speichern 
    //     // Methode fetch_all mit dem Parameter MYSQLI_ASSOC bewirkt, dass jedes Ergebnis als ein 
    //     // assoziatives Array (also ein Array mit benannten Schlüsseln) zurückgegeben wird. 
    //     $events = $result->fetch_all(MYSQLI_ASSOC);

    //     //gibt das array aus
    //     // var_dump($events); 

    //     // erstellt eine doppelt verkettete Liste 
    //     // $mainList = new SplDoublyLinkedList(); 

    //     // for($i = 0; $i <6; $i++){
    //     //     foreach( $events as $event){
    //     //         if($event['date'])
    //     //     }
    //     // }

    //     return $events;
    // }

    function addCalendarEvent($date, $description){
        $conn = Database::getConnection();
        // vorbereitete SQL-Anweisung 
        // VALUES (?, ?)' - Bestandteil von INSERT & gibt Werte an, die in die genannten Spalten eingefügt werden 
        // ? sind Platzhalter
        $stmt = $conn ->prepare('INSERT INTO calendar_events (date, description) VALUES (?, ?)');
        // Parameter binden 
        $stmt->bind_param('ss', $date, $description); 
        return $stmt->execute(); 
    }

    // Kalender Events in mehrdimensionale arrays sortieren 


    // Verarbeitung der POST Anfrage
    function processFormSubmission() {
        // WO ZIEHT ER DIE METHOD RAUS?
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Eingabevalidierung und -sanitization
            $date = filter_input(INPUT_POST, 'date', FILTER_DEFAULT);
            $description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);


            
            if (!empty($date) && !empty($description)) {
                $success = addCalendarEvent($date, $description);
                if($success) {
                    return "Event erfolgreich erstellt!";
                } else {
                    return "Fehler beim Erstellen des Events."; 
                }
            } else {
                return "Bitte alle Felder ausfüllen.";
            }
        }
        return null; // kein POST-Request
    }
    //**********************************************/
    //************** SQL Kalender ******************/



    //**********************************************/
    //************** Ajax Handler ******************/
    // man kann das auch in eine seperate Datei auslagern


    //**********************************************/
    //************** Login Funktionen **************/


    //**********************************************/
    //************ Kalender erstellen **************/

