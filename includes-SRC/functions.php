<?php

    require_once 'db.php';

    function getCalendarEvents(){
        $conn = getDbConnection(); 
        // eine SQL-Abfrage ausführen, um alle Einträge aus der Tabelle 'calendar_events' auszuwählen,
        // und die Ergebnisse nach dem Datum aufsteigend zu sortieren - ASC = ascending - aufsteigend
        $result = $conn->query('SELECT * FROM calendar_events ORDER BY date ASC'); 
        // Ergebnisse in assoziativen Array speichern 
        // Methode fetch_all mit dem Parameter MYSQLI_ASSOC bewirkt, dass jedes Ergebnis als ein 
        // assoziatives Array (also ein Array mit benannten Schlüsseln) zurückgegeben wird. 
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function addCalendarEvent($date, $description){
        $conn = getDbConnection(); 
        // vorbereitete SQL-Anweisung 
        // VALUES (?, ?)' - Bestandteil von INSERT & gibt Werte an, die in die genannten Spalten eingefügt werden 
        // ? sind Platzhalter
        $stmt = $conn ->prepare('INSERT INTO calender_events (date, description) VALUES (?, ?)');
        // Parameter binden 
        $stmt->bind_param('ss', $date, $description); 
        return $stmt->execute(); 
    }



    // Verarbeitung der POST Anfrage
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date = $_POST['date'];
        $description = $_POST['description'];
        $success = addCalendarEvent($date, $description);
        if ($success) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }