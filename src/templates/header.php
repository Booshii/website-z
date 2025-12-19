<?php 
	
?> 

<header class="header">
	<a href="<?= $config['base_url']?>/home" id="site-brand" aria-label="Zur Startseite">
		<h1 id="header__h1">
			LINDENHOF
			<span id="header__h1__span">
				<?=htmlspecialchars($pageTitle ?? "Ferienwohnungen Zermützel", ENT_QUOTES, 'UTF-8') ?>
			</span>
		</h1>
	</a>
	<div id="header-redirections">
		<!-- <a href="#">
			<img src="/pics/pictogramme/Instagram.svg" alt="Instagram-Logo" class="">
		</a>
		<a href="https://www.gunns-kuchen.de/" target="_blank" class="">
			<img src="/pics/pictogramme/Instagram.svg" alt="Haus">
		</a> -->
		<img src="/pics/pictogramme/instagram-03.1.svg" class="header-redirections__img" alt="Haus">
		<img src="/pics/pictogramme/cake_icon.svg" class="header-redirections__img" alt="Haus">
		<button id="menu-btn">&#9776;</button>
	</div>
	

	<dialog id="menu-modal-element">
		<div class="dialog-inner">
			<!-- <button id="menu-close-button" aria-label="Menü schließen">&times;</button> -->
			<nav class="header__nav">
				<a href="<?= $config['base_url']?>/home">Startseite</a>
				<a href="<?= $config['base_url']?>/fewo1">große Ferienwohnung</a>
				<a href="<?= $config['base_url']?>/fewo2">kleine Ferienwohnung</a>
				<a href="#booking-section" aria-label="Zum Kontaktbereich" id="link-to-contact">Kontakt</a>
			</nav>
		</div>
	</dialog>

</header>

	