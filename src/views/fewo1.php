<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeWo1</title>
   		<link rel="stylesheet" href="/css/global.css">
		<link rel="stylesheet" href="/css/fewo1.css">
		<link rel="stylesheet" href="/css/calendar.css">
		<script src="../../js/fewo.js" defer></script>
</head>
<body>
	<header>
			<h1> LINDENHOF <span> Ferienwohnung 1</span></h1>
		
		<div class="socials">
			<a href="" class="Instagram">Instagram</a>
			<a href="" class="cafe">Gartencafe</a>
		</div>
	</header>

	<main>
		<section class="picture-gallery">
			<div class="container-pictures">
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

		<section class="equipment">
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
							<li>Schlafsofa</li>
							<li>Wander- und Fahrradkarten</li>
						</ul> 
					</div>
					<div class="equipment-küche">
						<h2>Küche</h2>						
						<ul>
							<li>Esstisch und Stühle für 4 Personen(+2 Klappstühle)</li>
							<li>Kühlschrank mit Gefrierfach</li>
							<li>Ceranfeld und Herd (mit Blechen, Springform, Muffinform)</li>
							<li>Kaffeemaschine, French Press und Milchschäumer</li>
							<li>Toaster</li>
							<li>Wasserkocher</li>
							<li>Messerblock</li>
							<li>Grundausstattung Geschirr und Besteck und Kochutensilien</li>
							<li>Topfset mit großem Topf</li>
							<li>Pfannen und Auflaufformen</li>
							<li>große Schüssel, Rührschüssel </li>
							<li>Nudelsieb, Reibe</li>
							<li>Mixer, Pürierstab, Zerkleinerer</li>
							<li>Reinigungszeug</li>
						</ul> 
					</div>
					<div class="equipment-terasse">
						<h2>Terasse</h2>						
						<ul>
							<li>Tisch mit vier Stühlen</li>
							<li>Sonnenschirm</li>
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
							<li>Waschmaschine</li>
							<li>Föhn</li>
							<li>Seife</li>
						</ul> 
					</div>
				<div class="equipment-schlafzimmer">
					<h2>Schlafzimmer</h2>						
					<ul>
						<li>160x200m Bett</li>
						<li>Bettwäsche</li>
						<li>Fenster mit Jalousien</li>
						<li>Kommode</li>
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
				<div class="terasse-btn-container">
					<div class="equipment-abstellraum">
						<h2>Abstellraum</h2>						
						<ul>
							<li>Kleiderstange</li>
							<li>Reinigungsmittel</li>
							<li>Staubsauger</li>
							<li>Outdoor-Kissen</li>
						</ul> 
					</div>
					<button id="equipment-more-btn">Weitere Hinweise</button>
				</div>
			</div>	
			
			
			
	</section>
	<section class="availability-prices">
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
				<!-- <select name="select-month" id="select-month-year" onchange="updateCalendar()"> -->
				
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
	</section>
	<section class="booking">
		<h1>Buchen</h1>
		<p>Telefon: 0173-8545737 oder </br>
			E-Mail: ferienwohnung@lindenhof-zermuetzel.de
		</p>
	</section>
		
	</main>
	<dialog id="modal-element">
		<header class="modal__header">
			<h1>Ferienwohnung 1</h1>
			<button id="modal-close-button">&times;</button>
		</header>
		<div id="modal__content">
			<p>
				Die Unterkunft ist auf zwei Ebenen. Unten befinden sich das Wohnzimmer mit Kamin und Schlafmöglichkeit (Schlafcouch für Gast 5+6). Das Wohnzimmer ist verbunden mit der Küche und dem Ausgang zur Terrasse. Das Schlafzimmer ist als einziger Raum komplett zum Abdunkeln und mit Tür. Das zweite Bett ist über eine Treppe (hier kann man nicht stehen) zu erreichen und hat einen schönen Blick auf unseren Garten. Neben der größeren Ferienwohnung ist noch unsere zweite Ferienwohnung. Diese sind nicht miteinander verbunden und haben jeweils einen privaten Eingang und die Terassen sind getrennt.
				Der Eingang der Ferienwohnung ist über den Hof der Gastgeberin zu erreichen. Die Terrasse ist jedoch komplett privat und nicht einsehbar für die Gastgeberin. Bitte respektieren Sie den Privatbereich der Gastgeberin.
			</p>
			<h2>WICHTIG</h2>
			<p>
				Zur und nach Ihrem Aufenthalt wird gemeinsam der aktuelle Zählerstand abgelesen und die Kosten des Verbrauches werden anhand des aktuellen Tarifs (der Stadtwerke Neuruppin) berechnet. Das bedeutet, die Koste für Ihren Stromverbrauch werden im Nachhinein berechnet und Ihnen in Rechnung gestellt. Wir wollen uns damit in keinem Fall bereichern, sondern lediglich einen sparsamen Energieverbrauch anregen.
				</br>
				Die Wärme kommt ausschließlich über den Kamin. Nur im Bad gibt es eine elektronische Heizung. Deshalb ist die FeWo im Winter günstiger, weil der Verbrauch teurer ist. Hausschuhe sind in der ganzen Ferienwohnung von Vorteil. Sie können für den Kamin gerne eigenes Feuerholz (nur naturbelassenes) mitbringen oder bei uns für 8,50€ (kleiner Korb) kaufen.
			</p>
			<h2>REGELN</h2>
			<p>
				In der gesamten Ferienwohnung ist Rauchverbot!</br>
				Tiere sind aufgrund unserer zwei Hausdamenkatzen und den Allergikern nicht erlaubt.</br>
				Wir haben unsere Ferienwohnung mit viel Liebe und Aufwand gestaltet, daher bitten wir unsere Gäste, alles mit Respekt und Sorgfalt zu behandeln, damit wir noch sehr lange Gäste begrüßen können.
				</br>
				Das Gartencafé ist vom 1. Mai bis zum letzten Septemberwochenende immer Samstag und Sonntag von 13-18 Uhr geöffnet.
				https://www.gunns-kuchen.de/
			</p>

		</div>
		<footer class="modal__footer">

		</footer>
	</dialog>
	<?php
			require_once TEMPLATE_PATH . "footer.php";
	?>
</body>
</html>