<?php
$view = ViewManager::getInstance();
?>

<!DOCTYPE html>
<html class="bc-login">

<head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/login.css" type="text/css">
	<link rel="stylesheet" href="css/toggleLang.css" type="text/css">

	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>

<body>
	<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
</body>

</html>

<script>
	const toggleLang = document.getElementById('toggleLang')

	toggleLang.addEventListener('click', function() {

		const altLang = document.querySelector('.current-alternative-language')
		window.location.href = 'index.php?controller=language&action=change&lang=' + altLang.textContent.toLocaleLowerCase();
	});
</script>