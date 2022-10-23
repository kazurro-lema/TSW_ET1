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
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
	<link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet">
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
	<?php
	include(__DIR__ . "/sidenav.php");
	?>

	<main>

		<card-title>
			<h3>Blog</h3>
		</card-title>
		
		<nav id="menu" style="background-color:grey">
			<ul>
				<li><a href="index.php?controller=posts&amp;action=index">Posts</a></li>

				<?php if (isset($currentuser)) : ?>
					<li><?= sprintf(i18n("Hello %s"), $currentuser) ?>
						<a href="index.php?controller=users&amp;action=logout">(Logout)</a>
					</li>

				<?php else : ?>
					<li><a href="index.php?controller=users&amp;action=login"><?= i18n("Login") ?></a></li>
				<?php endif ?>
			</ul>
		</nav>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>

		<?php
		include(__DIR__ . "/language_select_element.php");
		?>
	</main>

</body>

</html>