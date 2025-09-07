<?php
    
    function renderCalendar($month, $year, $calendar_events){
        // include SRC_URL . '/functions.php';
        // $calendar_events = getOneMonthCalendarEvents($month, $year); 
        $event_index = 0; 

        // Erster Tag des aktuellen Monats als Zahl (Montag = 1, Sonntag = 7)
        $first_day = date('N', strtotime("$year-$month-01"));
        // Anzahl der Tage im aktuellen Monat
        $days_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        

        echo'
        <table id="first-calendar" class="calendar">
            <thead>
                <tr>
                    <th>Mo</th>
                    <th>Di</th>
                    <th>Mi</th>
                    <th>Do</th>
                    <th>Fr</th>
                    <th>Sa</th>
                    <th>So</th>
                </tr>
            </thead>
            <tbody>
        ';
        // ein Kalender besteht hier aus 7 Spalten für die Tage und 5 Reihen für die Wochen 
        // 
        // Tageszähler
        $current_day = 1; 
        // Erstellen der Kalenderzeilen(Wochen)
        for ($i = 0; $i < 6; $i++) {
            echo'
            <tr>';
            // erstellt der Kalenderzellen(Tage)
            for ($j = 1; $j < 8; $j++){  

                // leere Zellen für die Tage vor dem 1. Tag des Monats
                if($i === 0 && $j < $first_day){
                    echo '<td></td>';
                // wenn der letzte Tag des Monats erreicht wird (28, 30, 31) wird beendet 
                } elseif ($current_day > $days_month){
                    break; 
                // Erstellen einer Zelle für jeden Tag
                } else {
                    $current_date = (new DateTime("$current_day-$month-$year"))->format('Y-m-d');
                    
                    if( isset($calendar_events[$event_index]) && $current_date === $calendar_events[$event_index]['event_date']) {
                        echo '<td class="day-box occupied">T</td>';
                        if($event_index < count($calendar_events) - 1 ){
                            $event_index++;
                        }
                    } else {
                        echo '<td class="day-box spare">$current_day</td>';
                    }
                    $current_day++;   
                }
            }
            echo'
            </tr>';                 
        }
        echo'
            </tbody>
        </table>';
    

    }

    