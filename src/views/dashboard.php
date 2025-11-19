<?php
/**
	* required variables 
	* @param int $displayed_month 
	* @param int $displayed_year
	* @param int $displayed_flat
	* @param array $calendar_events  
	* @return string HTML-Tabelle
  * @var string $csrfToken
* */
?>
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
	<main>
  	<h1 id="title">Wohnung auswählen</h1>

		<select name="select-flat" id="select-flat">
			<option value="1"<?= $displayed_flat === 1 ? 'selected' : '' ?>>Wohnung 1</option>
			<option value="2"<?= $displayed_flat === 2 ? 'selected' : '' ?>>Wohnung 2</option>
		</select>

		<div class="calendar-container">
			<div class="calendar-nav">
				<button id='prev-month'>&laquo;</button>
				<div class="calendar-select-container">
					<select name="select-month" id="select-month">
						<?php
							$months = ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'];
							foreach($months as $key => $m){
								if($displayed_month  == $key + 1){
									echo '<option value="' . ($key + 1) . '" selected>' . $m . '</option>'; 
								} else {
									echo '<option value="' . ($key + 1) . '">' . $m . '</option>'; 
								}	
							}
						?>
					</select>
					<select name="select-year" id="select-year">
						<?php
							for ($i = -2; $i < 4; $i++) {
								$option_year = $displayed_year + $i;
								if($displayed_year == $option_year) {
									echo '<option value="' . $option_year . '" selected>' . $option_year . '</option>';
								} else {
									echo '<option value="' . $option_year . '">' . $option_year . '</option>';
								}
							}
						?>
					</select>
				</div>
				<button id="next-month">&raquo;</button>
			</div>
			<div class="calendar" id="calendar-container">
				<?php
					require_once TEMPLATE_PATH . 'calendar.php';
					echo renderCalendar($displayed_month, $displayed_year, $calendar_events);
				?>
			</div>
			<!-- <div id="legend-container">
            <h1>Legende</h1>
            <div class="legend-item">
              <div class="square-green" ></div>
							<h2>Verfügbar</h2>
            </div>
            <div class="legend-item">
							<div class="square-red" ></div>
							<h2>Gebucht</h2>
            </div>
        </div> -->
		</div>
		<div class="form-container">
			<div class="form-container-head">
				<h2>Verfügbarkeit</h2>
				<h2>Beschreibung</h2>
				<button type="submit" form="dashboard-form" name="submit_button" class="form-container__button">speichern</button>
			</div>
			<form action="/controller" method="POST" id="dashboard-form">
				<input type="hidden" name="submited_flat" value="<?= (int)$displayed_flat?>">																																	
				<?php 
					$days = 31; 
					$event_index = 0;
					for($i = 1; $i <= $days; $i++){ 
						$current_date = (new DateTime("$displayed_year-$displayed_month-$i"))->format('Y-m-d');	
						if( isset($calendar_events[$event_index]) && $current_date === $calendar_events[$event_index]['event_date']) {
							$description = $calendar_events[$event_index]['description']; 
							echo'
								<input type="hidden" name="dates[]" value="' .$current_date. '" >
								<label for="description' . $i . '" class="label-occupied form-label" id="status-label' . $i . '">' . $i . ' </label>
								
								<select name="select_status[' . $current_date . ']" class="form__select" id="select-status_' . $i . '" required>
									<option value=true>Verfügbar</option>
									<option value=false selected >Belegt</option>
								</select>

								<input type="text" class="form__input" id="description' . $i . '" name="description[' . $current_date . ']" value="' .$description. '" >   
							'; 

							if ($event_index < count($calendar_events) - 1) {
									$event_index++;
							}
						} else {
							echo'
								<input type="hidden" name="dates[]" value="' .$current_date. '" >

								<label for="description' . $i . '" class="label-spare form-label" id="status-label' . $i . '">' . $i . ' </label>

								<select name="select_status[' . $current_date . ']" class="form__select" id="select-status_' . $i . '" required>
									<option value=true>Verfügbar</option>
									<option value=false>Belegt</option>
								</select>
								
								<input type="text" class="form__input" id="description' . $i . '" name="description[' . $current_date . ']">
							'; 
						}
					}
				?>
				<input type="hidden" name="csrf_token"
					value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>" 	
				>
			</form>
			<button type="submit" form="dashboard-form" name="submit_button" class="form-container__button">speichern</button>
		</div>

	</main>
</body>
</html>