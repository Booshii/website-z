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
	<button id="menu-btn">&#9776;</button>
</header>

<dialog id="menu-modal-element">
	<button id="menu-close-button" aria-label="Menü schließen">&times;</button>
	<nav>
		<a href="<?= $config['base_url']?>/home">Startseite</a>
		<a href="<?= $config['base_url']?>/fewo1">große Ferienwohnung</a>
		<a href="<?= $config['base_url']?>/fewo2">kleine Ferienwohnung</a>
		<a href="#booking-section" aria-label="Zum Kontaktbereich" id="link-to-contact">Kontakt</a>
	</nav>
</dialog>