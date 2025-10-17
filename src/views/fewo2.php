<?php

?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ferienwohnung 2</title>
	<link rel="stylesheet" href="/css/global.css">
	<link rel="stylesheet" href="/css/fewo2.css">
	<link rel="stylesheet" href="/css/calendar.css">
	<script src="../../js/fewo2.js" defer></script>
</head>
<body>
	<?php
		require_once TEMPLATE_PATH . "header.php";
	?> 
  <main>
    <section class="picture-gallery-section">
			<div class="pictures-container">
        <img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="1">
        <img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="2">
        <img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="3">
        <img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="4">
        <img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="5">
        <img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="6">
        <img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="7">
        <img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="8">
			</div>
		</section>
		<section class="equipment-section">
			<h1>Ausstattung</h1>
			<div class="equipment-container">
				<div class="equipment-container-left">
					<div class="equipment-wohnzimmer">
						<h2>Wohnzimmer</h2>						
							<ul>
								<li>Kamin</li>
								<li>TV(mit HDMI und USB-Anschluss)</li>
								<li>WLAN</li>
								<li>Spiele und Bücher (Kinder- und Jugendbücher, Romane)</li>
								<li>Gaderobe</li>
								<li>Wander- und Fahrradkarten</li>
							</ul>
					</div>
					<div class="equipment-küche">
						<h2>Küche</h2>						
						<ul>
							<li>Esstisch und Stühle für 2 Personen(+ ein Klappstühle)</li>
							<li>Kühlschrank mit Gefrierfach</li>
							<li>Ceranfeld und Herd (mit Blechen, Springform, Muffinform)</li>
							<li>French Press</li>
							<li>Toaster</li>
							<li>Wasserkocher</li>
							<li>Messerblock</li>
							<li>Grundausstattung Geschirr und Besteck und Kochutensilien</li>
							<li>Topfset mit großem Topf</li>
							<li>Pfannen und Auflaufformen</li>
							<li>große Schüssel, Rührschüssel </li>
							<li>Nudelsieb und Reibe</li>
							<li>Mixer, Pürierstab, Zerkleinerer</li>
							<li>Reinigungszeug</li>
						</ul> 
					</div>
			</div>
				<div class="equipment-container-right">
					<div class="equipment-bad">
						<h2>Bad</h2>						
						<ul>
							<li>Dusche</li>
							<li>Toilette</li>
							<li>Fenster</li>
							<li>Handtücher</li>
							<li>Föhn</li>
							<li>Seife</li>
						</ul> 
					</div>
					<div class="equipment-schlafzimmer">
						<h2>Schlafzimmer</h2>						
						<ul>
							<li>160x200m Bett</li>
							<li>Bettwäsche</li>
							<li>Fenster mit Vorhängen</li>
							<li>Schrank</li>
						</ul> 
					</div>
					<div class="equipment-entspannbereich">
						<h2>Entspann-/Schlafbereich</h2>						
						<ul>
							<li>über Treppen erreichbar, nicht zum stehen geeignet</li>
							<li>Aussicht auf den Garten</li>
							<li>160x200m Matratze</li>
						</ul> 
					</div>
					<div class="equipment-terasse">
						<h2>Terasse</h2>						
						<ul>
							<li>Tisch mit vier Stühlen</li>
						</ul> 
					</div>
					<button id="equipment-more-btn">Weitere <br>Hinweise</button>
				</div>
			</div>
		</section>
		<section class="availability-prices-section">
			<div class="availability-prices-container">
				<div class="availability-container">
					<h1>VERFÜGBARKEIT</h1>
					<div class="calendar-container">
						<div class="calendar-nav">
							<button id='prev-month'>&laquo;</button>
							<div class="select-container">
								<select name="select-month" id="select-month">
									<?php
										// erzeugt die Auswahl für die nächsten 12 Monate
										$months = ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'];
										foreach($months as $key => $m){
											if($current_month == $key + 1){
												echo '<option value="' . ($key + 1) . '" selected>' . $m . '</option>'; 
											} else {
												echo '<option value="' . ($key + 1) . '">' . $m . '</option>'; 
											}
											
										}
									?>
								</select>
								<select name="select-year" id="select-year">
									<?php
										for ($i = 0; $i < 5; $i++){
											if($current_year == $i){
												$option_year = $current_year + $i;
												echo '<option value="' . $option_year . '" selected>' . $option_year . '</option>';
											} else {
												$option_year = $current_year + $i;
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
								echo renderCalendar($current_month, $current_year, $calendar_events);
							?>
						</div>
					</div>
				</div>
				<div class="price-container">
					<h1 class="price-head">PREISE</h1>
					<div class="summer">
						<h2>SOMMER</h2>
						<span class="subheadline">April-September</span>
						<p>
							Preis pro Nacht </br>
							für 1-4 Personen 85€ </br>
							pro weitere Person +15€
						</p>
						<p>
							Reinigung 55€ </br>
							Energiekosten lt. Verbrauch </br>
							Feuerholz Sack 8,50€
						</p>
					</div>
					<div class="winter">
						<h2>WINTER</h2>
						<span class="subheadline">Oktober-März</span>
						<p>
							Preis pro Nacht </br>
							für 1-4 Personen 120€ </br>
							pro weitere Person +15€
						</p>
						<p>
							Reinigung 55€ </br>
							Energiekosten lt. Verbrauch </br>
							Feuerholz Sack 8,50€
						</p>
					</div>
				</div>
			</div>
	</section>
		<section class="booking">
		<h1>Buchen</h1>
		<p>Telefon: 0173-8545737 oder </br>
			E-Mail: ferienwohnung@lindenhof-zermuetzel.de
		</p>
	</section>
  </main>
</body>
<?php
	require_once TEMPLATE_PATH . "footer.php";
?> 
</html>