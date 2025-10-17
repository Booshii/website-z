<?php
    /** 
     * required variables
     * @param int $month  
     * @param int $year  
     * @param array $calendar_events  
     * 
     * @return string HTML-Tabelle
     * */

    function renderCalendar(int $month, int $year, array $calendar_events): string{
        // Eingaben absichern 
        // gucken dass das vorher wo die Daten aus dem path genommen werden auch passiert
        $month = max(1, min(12, $month));
        $year  = max(1970, min(9999, $year));
        
        $events_by_day = [];
        foreach ($calendar_events as $e) {
            if(!isset($e['event_date'])) continue;
            $d = DateTimeImmutable::createFromFormat('!Y-m-d', (string)$e['event_date']);
            if(!$d) continue;
            $key = $d->format('Y-m-d');
            $events_by_day[$key] = $e;
        }

        // Monatsgrenzen berechnen
        $first_of_month = DateTimeImmutable::createFromFormat('!Y-m-d', sprintf('%04d-%02d-01', $year, $month));
        $last_of_month  = $first_of_month->modify('last day of this month');

        // Start der Montag der Woche, in der der 1. liegt bsp Do= 4 -1 = 3 also modify(-3days)
        $start = $first_of_month->modify('-' . ((int)$first_of_month->format('N') - 1) . ' days');
        // Sonntag der Woche des letzten Tags
        $end = $last_of_month->modify('+'. (7-(int)$last_of_month->format('N')) . ' days'); 

        $today_key = (new DateTimeImmutable('today'))->format('Y-m-d');

        $calendar_html = '<table id="first-calendar" class="calendar" aria-label="Kalender">';
        // $calendar_html .= '<caption>' . htmlspecialchars($first_of_month->format('F Y'), ENT_QUOTES, 'UTF-8') . '</caption>';
        $calendar_html .= '<thead>
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

        // Tage rendern 
        $cursor = $start;
        $col = 0;
        while ($cursor <=$end){
            if($col === 0){
                $calendar_html .= '<tr>';
            }
            // hier könnte Fehler liegen 
            $date_key = $cursor->format('Y-m-d');
            $day_num = (int)$cursor->format('j');
            $is_in_month = ((int)$cursor->format('n')) === $month;
            $is_today = $date_key === $today_key;
            $has_event = isset($events_by_day[$date_key]);
            // $aria_label = $hasEvent 
            //     ? "Tag $dayNum - 1 Ereignis" . ($title !== '' ? ": $title" : "")
            //     : "Tag $dayNum - frei";
            $classes = ['day-box'];
            if($is_in_month){
                $classes[] = $has_event ? 'occupied' : 'spare';
            } else {
                $classes[] = 'other-month';
            }
            if($is_today){
                $classes[] = 'today';
            }

            $calendar_html .= '<td class="'.implode(' ', $classes).'">';
            $calendar_html .= '<time datetime="'.$date_key.'">'.$day_num.'</time>';
            $calendar_html .= '</td>';

            $col++;
            if ($col === 7) {
                $calendar_html .= '</tr>';
                $col = 0;
            }
            $cursor = $cursor->modify('+1 day');
        }
        $calendar_html .= '</tbody></table>';
        return $calendar_html;

    }

    