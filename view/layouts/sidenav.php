<?php
?>

<header class="header" id="header">
	<div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>

	<?php include(__DIR__ . "/toggleLang.php"); ?>

</header>
<div class="l-navbar" id="nav-bar">
	<nav class="nav">
		<div>
			<a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Menu</span> </a>

			<div class="nav_list">
				<a href="index.php?controller=posts&amp;action=index" class="nav_link active"> <i class='material-icons'>dashboard</i> <span class="nav_name">Dashboard</span> </a>
				<a href="index.php?controller=posts&amp;action=add" class="nav_link"> <i class='material-icons'>note_add</i> <span class="nav_name">Añadir</span> </a>
				<a href="#" class="nav_link"> <i class='material-icons'>analytics</i> <span class="nav_name">Analiticas</span> </a>
			</div>
		</div>
		<a href="index.php?controller=users&amp;action=logout" class="nav_link"> <i class='material-icons'>power_settings_new</i> <span class="nav_name">SignOut</span> </a>
	</nav>
</div>