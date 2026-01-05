<?php

?> 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Lindenhof Zermützel Ferienwohnungen</title>
		<link rel="stylesheet" href="/css/home.css">
		<link rel="stylesheet" href="/css/global.css">
		<script src="/js/home.js" defer></script>
		<script src="/js/header.js" defer></script>
	</head>
	<body>
		<?php
			$pageTitle = "Zermützel Ferienwohnungen";
			require_once TEMPLATE_PATH . "header.php";
		?> 
		<main>
				<section class="general-information-section">
					<div class="banner-container">
						<img id="banner" src="pics/Banner.avif" alt="Banner">
					</div>
					<h1>Urlaub auf dem Lindenhof</h1>
					<p>
						Unsere Ferienwohnungen in der ausgebauten Scheune bieten Erholung für alle – ob mit Kindern, als Paar oder allein. 
						Eingebettet in die wunderbare Stille der Natur liegt Zermützel, umgeben von Wanderwegen, Seen und historischen Städten. 
						Die neu eingerichteten Wohnungen sind modern und voll ausgestattet. Große Linden spenden Schatten, und am Wochenende lädt unser hauseigenes Café zu einem Stück selbstgebackenem Kuchen ein. 
						Nur fünf Gehminuten entfernt liegt der See mit einer schönen Badewiese. 
						Und wenn der Tag einmal kühler war – zum Beispiel nach einem Spaziergang durch den Wald – lässt es sich abends wunderbar am Kamin entspannen.
					</p>
				</section>
		
				<section class="select-flat-section">
					<h1>Unsere Ferienwohnungen</h1>
					<div class="select-flat-button-container">
						<a href="<?= $config['base_url']?>/fewo1" class="button-select-flat">
							bis 6 Personen</a> 
							<!-- Unsere große Ferienwohnung<br><span>bis 6 Personen</span> -->
						
						<a href="<?= $config['base_url']?>/fewo2" class="button-select-flat">
							<span>bis 3 Personen</span> 
							<!-- Unsere kleine Ferienwohnung<br><span>bis 3 Personen</span> -->
						</a>
					</div>	
				</section> 

				<section class="picture-gallery-section">
					<!-- <h1>Bildergalerie</h1> -->
					<div class="container-pictures">
							<img src="pics/apt01/tiles/apt01-bedroom-01-tile.avif" data-full="pics/apt01/apt01-bedroom-01.avif" alt="Schlafzimmer" class="gallery-item" data-index="1">	
							<img src="pics/apt01/tiles/apt01-livingroom-01-tile.avif" data-full="pics/apt01/apt01-livingroom-01.avif" alt="Wohnzimmer" class="gallery-item" data-index="2">
							<img src="pics/apt01/tiles/apt01-upstairs-02-tile.avif" data-full="pics/apt01/apt01-upstairs-02.avif" alt="Oben" class="gallery-item" data-index="3">						
							<img src="pics/apt01/tiles/apt01-bath-01-tile.avif" data-full="pics/apt01/apt01-bath-01.avif" alt="Bad" class="gallery-item" data-index="4">			
							<img src="pics/apt02/tiles/apt02-bedroom-02-tile.avif" data-full="pics/apt02/apt02-bedroom-02.avif" alt="Schlafzimmer" class="gallery-item" data-index="5">
							<img src="pics/apt02/tiles/apt02-upstairs-01-tile.avif" data-full="pics/apt02/apt02-upstairs-01.avif" alt="Oben" class="gallery-item" data-index="6">
							<img src="pics/apt02/tiles/apt02-livingroom-01-tile.avif" data-full="pics/apt02/apt02-livingroom-01.avif" alt="Wohnzimmer" class="gallery-item" data-index="7">
							<img src="pics/apt02/tiles/apt02-outside-01-tile.avif" data-full="pics/apt02/apt02-outside-01.avif" alt="Draußen" class="gallery-item" data-index="8">
							<img src="pics/home/tiles/home-outside-06-tile.avif" data-full="pics/home/home-outside-06.avif" alt="Draußen" class="gallery-item" data-index="9">
							<img src="pics/home/tiles/home-outside-05-tile.avif" data-full="pics/home/home-outside-05.avif" alt="Draußen" class="gallery-item" data-index="10">
							<img src="pics/home/tiles/home-outside-01-tile.avif" data-full="pics/home/home-outside-01.avif" alt="Draußen" class="gallery-item" data-index="11">
							<img src="pics/home/tiles/home-hausdame-01-tile.avif" data-full="pics/home/home-hausdame-01.avif" alt="Hausdame" class="gallery-item" data-index="12">
							<img src="pics/home/tiles/home-cafe-01-tile.avif" data-full="pics/home/home-cafe-01.avif" alt="Cafe" class="gallery-item" data-index="13">
							<img src="pics/home/tiles/home-cafe-02-tile.avif" data-full="pics/home/home-cafe-02.avif" alt="Cafe" class="gallery-item" data-index="14">
							<img src="pics/home/tiles/home-obstwiese-01-tile.avif" data-full="pics/home/home-obstwiese-01.avif" alt="Obstwiese" class="gallery-item" data-index="15">
							<img src="pics/home/tiles/home-gardenview-01-tile.avif" data-full="pics/home/home-gardenview-01.avif" alt="Garten" class="gallery-item" data-index="16">
							<img src="pics/home/tiles/home-obstwiese-02-tile.avif" data-full="pics/home/home-obstwiese-02.avif" alt="Obstwiese" class="gallery-item" data-index="17">
							<img src="pics/home/tiles/home-outside-02-tile.avif" data-full="pics/home/home-outside-02.avif" alt="Draußen" class="gallery-item" data-index="18">	
					</div>
					<button id="gallery-more-button" > <strong>Mehr</strong> (18) <span class="plus">&#43</span></button>
				</section>
				<section class="map-section">
					<iframe class="map"
						style="border:0"
						loading="lazy"
						allowfullscreen
						referrerpolicy="no-referrer-when-downgrade"
						src="https://www.google.com/maps?q=Lindenhof%20Zerm%C3%BCtzel&output=embed">
					</iframe>
				</section>
				
				<section id="booking-section">
					<!-- <h2 id="booking-section-container__h2">Um zu buchen schreiben Sie bitte eine E-Mail oder kontaktieren Sie uns unter</h2> -->
					<h2 id="booking-section-container__h2">ZUM BUCHEN KONTAKTIEREN SIE UNS</h2> 
					<p id="booking-section-container__p">
						Adresse: Dorfstraße 12, 16827 Zermützel </br>
						Telefon: 0173-8545737 </br>
						E-Mail: ferienwohnung@lindenhof-zermuetzel.de
					</p>
				</section>
<!-- 
				<section class="redirections">
					<a href="#"  class="card">
						<img src="/pics/pictogramme/Instagram.svg" alt="Instagram-Logo" class="card__img">
						<span>Instagram</span>
					</a>
					<a href="https://www.gunns-kuchen.de/" target="_blank" class="card">
						<img src="/pics/pictogramme/Instagram.svg" alt="Haus" class="card__img">
						<span>Gartencafe</span>
					</a>
				</section> -->

				
		</main>
		<!-- Lightbox Overlay -->
			<dialog id="modal-element">
				<div class="modal-element-header">
					<!-- aria-live für Screenreader - wenn sich ändert wird es neu vorgelesen -->
					<span class="counter" id="counter" aria-live="polite"></span>
					<button id="close-button">Close</button>
				</div>
				<div id="modal-element-content">
					<button id="prev-button">&lt;</button>
					<img src="" alt="Modal Image" id="modal-image">
					<button id="next-button">&gt;</button>
				</div>
			</dialog>	
		<?php
			require_once TEMPLATE_PATH . "footer.php";
		?> 
	</body>
</html>
