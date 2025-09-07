<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
		<link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/dashboard.css">
		<link rel="stylesheet" href="/css/calendar.css">

    <script src="../../js/dashboard.js" defer></script>
</head>
<body>
    
    <h1 id="title">Kalender bearbeiten</h1>
    <div id="dropdown-container">
        <select name="select-flat" id="select-flat">
            <option value="1"<?= $current_flat === 1 ? 'selected' : '' ?>>Wohnung 1</option>
            <option value="2"<?= $current_flat === 2 ? 'selected' : '' ?>>Wohnung 2</option>
        </select>
    </div>

    <!-- <div class="calendar-settings"> -->
        <div id="calendar-container">
            <div class="calendar-nav">
							<button id='prev-month'>&#8592;</button>
							<!-- <select name="select-month" id="select-month-year" onchange="updateCalendar()"> -->
							<select name="select-month" id="select-month-year">
								<?php
									// erzeugt die Auswahl für die nächsten 12 Monate

									for ($i = -3; $i <13; $i++){
										//berechnet Modulo und :? gibt 12 zurück wenn links 0(was hier nur möglich ist)
										// aber auch wenn false, null oder '' rauskommen sollte(was hier nicht möglich ist)
										$option_month = ($current_month + $i) % 12 ?: 12;
										// berechnet wie viele volle Jahre diese Monatsverschiedung darstellt
										$option_year = $current_year + floor(($current_month + $i - 1) / 12);
										$option_monthName = date('F', mktime(0, 0, 0, $option_month, 10)); // Monat als Text
										if($i == 0 ){
												echo "<option value='$option_month-$option_year' selected>$option_monthName $option_year</option>";
										} else {
												echo "<option value='$option_month-$option_year'>$option_monthName $option_year</option>";
										}
									}
								?>

							</select>
							<button id="next-month">&#8594;</button>
            </div>
            <div id="calendar">
                <?php
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                    // include '../includes-SRC/functions.php';

                    // aktuellen Monat und Jahr holen und dann die funktion renderCalendar aufrufen 
                    // $month = 11; 
                    // $year = 2024; 

                    // die Funktion zum holen der termine sollte hier ausgeführt werden 
                    // include function für get 
                    // speichern der Termine aus dem Backend in eine Liste 
                    // Form erstellen 

                    include_once SRC_URL . '/templates/calendar.php';
                    renderCalendar($current_month, $current_year, $calendar_events); 

                    // echo '<pre>';
                    //     print_r($calendar_events);
                    // echo '</pre>';
                ?>
            </div>            
        </div>
        <div id="legend-container">
            <h1>Legende</h1>
            <div class="legend-item">
              <div class="square-green" ></div>
							<h2>Verfügbar</h2>
            </div>
            <div class="legend-item">
							<div class="square-red" ></div>
							<h2>Gebucht</h2>
            </div>
        </div>

        <!-- <div class="calendar-entry-form"> -->
        <form id="form-container" action="/controller" method="POST" >
            <div class="form-grid">   
							<h2>Verfügbarkeit</h2>
							<div></div>
							<div id="form-grid-description-and-button-container">
									<h2>Beschreibung</h2>>
									<button type="submit" name="submit_button" value="save_events">speichern</button>
									<input type="hidden" name="submited_flat" value="<?= (int)$current_flat?>">																																	
								</div> 
							<?php 
								$days = 31; 
								$event_index = 0;

								for($i = 1; $i <= $days; $i++){ 
									$current_date = (new DateTime("$current_year-$current_month-$i"))->format('Y-m-d');
									//formated_date wird in der getOneMonthCalendarEvents() erstellt 
									// echo "<pre>DEBUG: current_date = $current_date | formatted_date = " . 
									// ($calendar_events[$event_index]['event_date'] ?? 'Nicht vorhanden') . "</pre>";

									if( isset($calendar_events[$event_index]) && $current_date === $calendar_events[$event_index]['event_date']) {
										$description = $calendar_events[$event_index]['description']; 
										echo'
											<input type="hidden" name="dates[]" value="' .$current_date. '" >

											<label for="description' . $i . '" class="form-label" id="status-label' . $i . '" style="background: red;">' . $i . ' </label>
											
											<select name="select_status[' . $current_date . ']" id="select-status_' . $i . '" required>
												<option value=true>Verfügbar</option>
												<option value=false selected >Belegt</option>
											</select>

											<input type="text" id="description' . $i . '" name="description[' . $current_date . ']" value="' .$description. '" >   
										'; 
										// warum das hier? 
										if ($event_index < count($calendar_events) - 1) {
												$event_index++;
										}
									}
									else{
										echo'
											<input type="hidden" name="dates[]" value="' .$current_date. '" >

											<label for="description' . $i . '" class="form-label" id="status-label' . $i . '" style="background: green;">' . $i . ' </label>

											<select name="select_status[' . $current_date . ']" id="select-status_' . $i . '" required>
												<option value=true>Verfügbar</option>
												<option value=false>Belegt</option>
											</select>
											
											<input type="text" id="description' . $i . '" name="description[' . $current_date . ']">
										'; 
									}
								}
								echo'
								<button type="submit" name="submit_button" value="save_events">speichern</button>
								';
							?>
            </div>
        </form>
        
    <!-- </div> -->
</body>
</html>