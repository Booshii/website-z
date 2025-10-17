<?php

?> 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link rel="stylesheet" href="/css/style.css">
		<link rel="stylesheet" href="/css/global.css">
		<script src="/js/main.js" defer></script>
		<script src="/js/header.js" defer></script>
	</head>
	<body>
		<?php
			require_once TEMPLATE_PATH . "header.php";
		?> 
		<!-- <nav class="navbar">
			<a href="#">Home</a>
			<a href="#">Ausstattung</a>
			<a href="#">Bilder</a>
			<a href="#">Verfügbarkeit und Preise</a>
			<a href="#">Anreise</a>
			<a href="#">Gartencafe</a>
			<a href="#">Instagram</a> 
		</nav> 
		-->
		<!-- <hr class="divider"> -->
		<main>
					
			<!-- <section class="banner-pic-section">
				
			</section> -->
		<!-- 
				<section class="general-information">
						<img src="pics/Haus_page.jpg" alt="Haus" class="left-picture-general-info">
						<img src="pics/Bett_page.jpeg" alt="Bett" class="mid-picture-general-info">
						<img src="pics/Flur_page.jpeg" alt="Flur" class="right-picture-general-info">
						<h1 class="headline-general-info">Überschrift general information</h1>
						<p class="paragraph-general-info">Unsere Ferienwohnung in der ausgebauten Scheune ist für alle gemacht, ob mit Kindern, als Paar oder alleine. Bei uns herrscht die wunderbare stille der Natur und Zermützel ist umgeben von Wanderwegen, Seen und historischen Städten. Die Ferienwohnung ist neu und ist voll ausgestattet. Die großen Linden bieten Schatten und am Wochenende kann man im hauseigenem Café ein Stück selbst gemachten Kuchen genießen. Selbst nach einem kühleren Tag im Wald kann man es sich am Kamin gemütlich machen.</p>
				</section> 
		-->

				<section class="general-information-section">
					<img src="pics/Haus_page.jpg" alt="Banner">
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
					<!-- <button class="button-select-flat" onclick="location.href='<?= $config['base_url'] ?>/fewo1'">
						Unsere große Ferienwohnung <br> <span>bis 6 Personen</span>
					</button> -->
					<a href="<?= rtrim($config['base_url'], '/') ?>/fewo1" class="button-select-flat">
  Unsere große Ferienwohnung<br><span>bis 6 Personen</span>
</a>
					<button class="button-select-flat" onclick="location.href='<?= $BASE_URL ?>/fewo2'">
						Unsere kleine Ferienwohnung </br> <span>bis 3 Personen</span>
					</button>	
				</section>

				<section class="picture-gallery-section">
					<!-- <h1>Bildergalerie</h1> -->
					<div class="container-pictures">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="1">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="2">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="3">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="4">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="5">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="6">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="7">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="8">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="9">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="10">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="11">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="12">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="13">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="14">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="15">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="16">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="17">
							<img src="pics/Haus_page.jpg" data-full="pics/Haus_page.jpg" alt="Haus" class="gallery-item" data-index="18">
					</div>
					<button class="show-more-button" > more </button>
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
				<section class="booking-information-section">
					<h2>Um zu buchen schreiben Sie bitte eine E-Mail oder kontaktieren Sie uns unter</h2>
					<p>
						Adresse: Dorfstraße 12, 16827 Zermützel </br>
						Telefon: 0173-8545737 </br>
						E-Mail: ferienwohnung@lindenhof-zermuetzel.de
					</p>
								</section>
				
						

				<!-- <section class="booking">
					<p>Wir freuen uns, wenn Sie Interesse an unserer Ferienwohnung haben. Um eine Buchung vorzunehmen schreiben Sie uns bitte eine E-Mail oder rufen Sie uns an</p>
				
				</section>

				<section class="map">

				</section>
				<section class="contact">
					<p>
						Adresse: Dorfstraße 12, 16827 Zermützel </br>
						Telefon: 0173-8545737 </br>
						E-Mail: ferienwohnung@lindenhof-zermuetzel.de
					</p>
				</section> -->
				<section class="redirections">
					<a href="#"  class="card">
						<img src="/pics/pictogramme/Instagram.svg" alt="Instagram-Logo" class="card__img">
						<span>Instagram</span>
					</a>
					<a href="https://www.gunns-kuchen.de/" target="_blank" class="card">
						<img src="/pics/pictogramme/Instagram.svg" alt="Haus" class="card__img">
						<span>Gartencafe</span>
					</a>
				</section>

				
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
