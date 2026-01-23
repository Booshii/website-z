<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="page-id" content="1">
	<title>Lindenhof Ferienwohnung 2</title>
	<link rel="stylesheet" href="/css/global.css">
	<link rel="stylesheet" href="/css/fewo.css">
	<link rel="stylesheet" href="/css/calendar.css">
	<script>	
		window.APP_CONFIG = {
			API_BASE_URL: "<?=  htmlspecialchars($config['base_url']) ?>"
		};
	</script>
	<script src="../../js/fewo.js" defer></script>
	<script src="/js/header.js" defer></script>
</head>
<!-- 		"flat": 1, -->
<script type="application/json" id="image-json">
	{
		"lightboxImages": [
			{ "full": "pics/apt01/apt01-bedroom-01.avif", "alt": "Schlafzimmer-1"},
			{ "full": "pics/apt01/apt01-hall-01.avif", "alt": "Flur"},
			{ "full": "pics/apt01/apt01-kitchen-01.avif", "alt": "Küche"},
			{ "full": "pics/apt01/apt01-livingroom-01.avif", "alt": "Wohnzimmer-1"},
			{ "full": "pics/apt01/apt01-livingroom-02.avif", "alt": "Wohnzimmer-2"},
			{ "full": "pics/apt01/apt01-bath-01.avif", "alt": "Bad"},
			{ "full": "pics/apt01/apt01-outside-01.avif", "alt": "Draußen-1"},
			{ "full": "pics/apt01/apt01-upstairs-02.avif", "alt": "Oben-2"},
			{ "full": "pics/apt01/apt01-upstairs-03.avif", "alt": "Oben-3"},
			{ "full": "pics/apt01/apt01-upstairs-01.avif", "alt": "Oben-1"},
			{ "full": "pics/apt01/apt01-outside-03.avif", "alt": "Draußen-3"},
			{ "full": "pics/apt01/apt01-outside-02.avif", "alt": "Draußen-2"}
		]
	}
</script>
<body>
	<?php
		$pageTitle = "Ferienwohnung 1";
		require_once TEMPLATE_PATH . "header.php";
	?>

	<main>
		<section class="picture-gallery-section">
			<div class="pictures-container">
				<img src="pics/apt01/tiles/apt01-bedroom-01-tile.avif" alt="Schlafzimmer" class="gallery-item" data-index="1">
				<img src="pics/apt01/tiles/apt01-hall-01-tile.avif" alt="Flur" class="gallery-item" data-index="2">
				<img src="pics/apt01/tiles/apt01-kitchen-01-tile.avif" alt="Küche" class="gallery-item" data-index="3">
				<img src="pics/apt01/tiles/apt01-livingroom-01-tile.avif" alt="Haus" class="gallery-item" data-index="4">
				<img src="pics/apt01/tiles/apt01-livingroom-02-tile.avif" alt="Haus" class="gallery-item" data-index="5">
				<img src="pics/apt01/tiles/apt01-bath-01-tile.avif" alt="Haus" class="gallery-item" data-index="6">
				<img src="pics/apt01/tiles/apt01-outside-01-tile.avif" alt="Haus" class="gallery-item" data-index="7">
				<img src="pics/apt01/tiles/apt01-upstairs-02-tile.avif" alt="Haus" class="gallery-item" data-index="8">
			</div>
			<button id="gallery-more-button" > <strong>Mehr</strong> (8) <span class="plus">&#43</span></button>
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
							<li>Spiele und Bücher </li>
							<li>Schlafsofa</li>
							<li>Wander- und Fahrradkarten</li>
						</ul> 
					</div>
					<div class="equipment-küche">
						<h2>Küche</h2>						
						<ul>
							<li>Esstisch und Stühle für 4 Personen(+2 Klappstühle)</li>
							<li>Kühlschrank mit Gefrierfach</li>
							<li>Ceranfeld und Herd </li>
							<!-- <li>Ceranfeld und Herd (mit Blechen, Springform, Muffinform)</li> -->
							<li>Kaffeemaschine, French Press und Milchschäumer</li>
							<li>Toaster, Wasserkocher, Messerblock</li>
							<!-- <li>Wasserkocher</li>
							<li>Messerblock</li> -->
							<li>Grundausstattung Geschirr und Besteck und Kochutensilien</li>
							<li>Topfset mit großem Topf</li>
							<li>Pfannen und Auflaufformen</li>
							<li>große Schüssel, Rührschüssel </li>
							<li>Nudelsieb, Reibe</li>
							<li>Mixer, Pürierstab, Zerkleinerer</li>
							<!-- <li>Reinigungszeug</li> -->
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
							<li>Föhn, Seife</li>
						</ul> 
					</div>
				<div class="equipment-schlafzimmer">
					<h2>Schlafzimmer</h2>						
					<ul>
						<li>140x200m Bett</li>
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
						<li>155x200m Matratze</li>
					</ul> 
				</div>
				<div class="equipment-abstellraum">
					<h2>Abstellraum</h2>						
					<ul>
						<li>Kleiderstange</li>
						<li>Reinigungsmittel</li>
						<li>Staubsauger</li>
						<li>Outdoor-Kissen</li>
					</ul> 
				</div>
				<button id="equipment-more-btn">Weitere <br>Hinweise</button>
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
					<span class="subheadline">April&ndash;September</span>
					<p>
						Preis pro Nacht </br>
						für 1&ndash;4 Personen 125€ </br>
						pro weitere Person +15€
					</p>
					<p>
						Reinigung 60€ </br>
						Energiekosten lt. Verbrauch </br>
						Feuerholz kleiner Sack 8,50€
					</p>
				</div>
				<div class="winter">
					<h2>WINTER</h2>
					<span class="subheadline">Oktober&ndash;März</span>
					<p>
						Preis pro Nacht </br>
						für 1&ndash;4 Personen 90€ </br>
						pro weitere Person +10€
					</p>
					<p>
						Reinigung 60€ </br>
						Energiekosten lt. Verbrauch </br>
						Feuerholz kleiner Sack 8,50€
					</p>
				</div>
			</div>
		</div>
	</section>
	<section id="booking-section">
		<h1>Buchen</h1>
			<p id="booking-section__p">
				Telefon: 0173-8545737 oder </br>
				E-Mail: ferienwohnung@lindenhof-zermuetzel.de
			</p>
	</section>
	</main>

	<dialog id="equipment-modal-element">
		<header class="equipment-modal__header">
			<h1 id="equipment-modal__header__h1">Ferienwohnung 1</h1>
			<button id="equipment-modal-close-button">&times;</button>
		</header>
		<div id="equipment-modal__content">
			<p>
				Die Unterkunft ist auf zwei Ebenen. Unten befinden sich das Wohnzimmer mit Kamin und Schlafmöglichkeit (Schlafcouch für Gast 5+6). Das Wohnzimmer ist verbunden mit der Küche und dem Ausgang zur Terrasse. Das Schlafzimmer ist als einziger Raum komplett zum Abdunkeln und mit Tür. Das zweite Bett ist über eine Treppe (hier kann man nicht stehen) zu erreichen und hat einen schönen Blick auf unseren Garten. Neben der größeren Ferienwohnung ist noch unsere zweite Ferienwohnung. Diese sind nicht miteinander verbunden und haben jeweils einen privaten Eingang und die Terassen sind getrennt.
				Der Eingang der Ferienwohnung ist über den Hof der Gastgeberin zu erreichen. Die Terrasse ist jedoch komplett privat und nicht einsehbar für die Gastgeberin. Bitte respektieren Sie den Privatbereich der Gastgeberin.
			</p>
			<h2 id="equipment-modal__content__h2">WICHTIG</h2>
			<p>
				Zur und nach Ihrem Aufenthalt wird gemeinsam der aktuelle Zählerstand abgelesen und die Kosten des Verbrauches werden anhand des aktuellen Tarifs (der Stadtwerke Neuruppin) berechnet. Das bedeutet, die Koste für Ihren Stromverbrauch werden im Nachhinein berechnet und Ihnen in Rechnung gestellt. Wir wollen uns damit in keinem Fall bereichern, sondern lediglich einen sparsamen Energieverbrauch anregen.
				</br>
				Die Wärme kommt ausschließlich über den Kamin. Nur im Bad gibt es eine elektronische Heizung. Deshalb ist die FeWo im Winter günstiger, weil der Verbrauch teurer ist. Hausschuhe sind in der ganzen Ferienwohnung von Vorteil. Sie können für den Kamin gerne eigenes Feuerholz (nur naturbelassenes) mitbringen oder bei uns für 8,50€ (kleiner Korb) kaufen.
			</p>
			<h2 id="equipment-modal__content__h2">REGELN</h2>
			<p>
				In der gesamten Ferienwohnung ist Rauchverbot!</br>
				Tiere sind aufgrund unserer zwei Hausdamenkatzen und den Allergikern nicht erlaubt.</br>
				Wir haben unsere Ferienwohnung mit viel Liebe und Aufwand gestaltet, daher bitten wir unsere Gäste, alles mit Respekt und Sorgfalt zu behandeln, damit wir noch sehr lange Gäste begrüßen können.
				</br>
				Das Gartencafé ist vom 1. Mai bis zum letzten Septemberwochenende immer Samstag und Sonntag von 13-18 Uhr geöffnet.
				https://www.gunns-kuchen.de/
			</p>
		</div>
		<footer class="equipment-modal__footer">

		</footer>
	</dialog>

	<!-- Lightbox Gallery -->
	<dialog id="gallery-modal-element">
		<header id="gallery-modal__header">
		<!-- aria-live für Screenreader - wenn sich ändert wird es neu vorgelesen -->
			<span class="counter" id="counter" aria-live="polite"></span>
			<button id="gallery-modal-close-button" class="gallery-modal-element__button">&times;</button>
		</header>
		<div id="gallery-modal__content">
			<button id="gallery-modal-prev-button" class="gallery-modal-element__button">&lt;</button>
			<img src="" alt="Modal Image" id="gallery-modal-image">
			<button id="gallery-modal-next-button" class="gallery-modal-element__button">&gt;</button>
		</div>
	</dialog>	
	<?php
			require_once TEMPLATE_PATH . "footer.php";
	?>
</body>
</html>