<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?>
<!DOCTYPE html>
<html>

<head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">

	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/toggleLang.css" type="text/css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<!-- enable ji18n() javascript function to translate inside your scripts -->
	<script src="index.php?controller=language&amp;action=i18njs">
	</script>
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>

<body id="body-pd">
	<!-- header -->
	<?php include(__DIR__ . "/sidenav.php"); ?>

	<main>
		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>

</body>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {

		const showNavbar = (toggleId, navId, bodyId, headerId) => {
			const toggle = document.getElementById(toggleId),
				nav = document.getElementById(navId),
				bodypd = document.getElementById(bodyId),
				headerpd = document.getElementById(headerId)

			if (toggle && nav && bodypd && headerpd) {
				toggle.addEventListener('click', () => {

					nav.classList.toggle('show')
					toggle.classList.toggle('bx-x')
					bodypd.classList.toggle('body-pd')
					headerpd.classList.toggle('body-pd')
				})
			}
		}

		showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

		/*===== LINK ACTIVE =====*/
		const linkColor = document.querySelectorAll('.nav_link')
		const action = new URL(location.href).searchParams.get('action')

		if (linkColor) {

			linkColor.forEach(l => l.classList.remove('active'))
			linkColor.forEach(l => {
				if (l.href.endsWith(action)) {
					l.classList.add('active')
				}
			});
		}

		/*===== Toogle Idioma =====*/
		const toggleLang = document.getElementById('toggleLang')

		toggleLang.addEventListener('click', function() {
			const altLang = document.querySelector('.current-alternative-language')

			window.location.href = 'index.php?controller=language&action=change&lang=' + altLang.textContent.toLocaleLowerCase();
		});

	});
</script>

</html>