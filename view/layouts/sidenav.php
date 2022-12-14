<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$currentuser = $view->getVariable("currentusername");
?>

<header class="header" id="header">
	<div class="header_toggle"> <mat-icon id="header-toggle" class="material-icons material-symbols-outlined">menu</mat-icon></div>
	<?php include(__DIR__ . "/toggleLang.php"); ?>
</header>

<div class="l-navbar" id="nav-bar">
	<nav class="nav">
		<div>
			<a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon material-icons material-symbols-outlined'>polymer</i> <span class="nav_logo-name">Menu</span> </a>

			<div class="nav_list">
				<a href="index.php?controller=gastos&amp;action=index" class="nav_link"> <i class='material-icons material-symbols-outlined'>dashboard</i> <span class="nav_name"><?= i18n("Dashboard") ?></span> </a>
				<a href="index.php?controller=gastos&amp;action=add" class="nav_link"> <i class='material-icons material-symbols-outlined'>note_add</i> <span class="nav_name"><?= i18n("Add Gasto") ?></span> </a>
				<a href="index.php?controller=gastos&amp;action=charts" class="nav_link"> <i class='material-icons material-symbols-outlined'>analytics</i> <span class="nav_name"><?= i18n("Charts") ?></span> </a>
			</div>
		</div>
		<div>
			<a href="index.php?controller=users&amp;action=view" class="nav_link"> <i class='material-icons material-symbols-outlined'>person</i> <span class="nav_name"> <?= $view->getVariable("currentusername") ?></span></a>
			<a href="index.php?controller=users&amp;action=logout" class="nav_link"> <i class='material-icons material-symbols-outlined'>power_settings_new</i> <span class="nav_name"><?= i18n("SignOut") ?></span> </a>
		</div>
	</nav>
</div>