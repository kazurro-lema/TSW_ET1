<?php
// file: view/layouts/sidenav.php
?>
<header class="header" id="header">
	<div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
</header>
<div class="l-navbar" id="nav-bar">
	<nav class="nav">
		<div>
			<a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Menu</span> </a>

			<div class="nav_list">
				<a href="index.php?controller=posts&amp;action=index" class="nav_link active"> <i class='material-icons'>dashboard</i> <span class="nav_name">Dashboard</span> </a>
				<a href="index.php?controller=posts&amp;action=view" class="nav_link"> <i class='material-icons'>assignment</i> <span class="nav_name">Post</span> </a>
				<a href="index.php?controller=posts&amp;action=add" class="nav_link"> <i class='material-icons'>note_add</i> <span class="nav_name">Añadir</span> </a>
				<a href="#" class="nav_link"> <i class='material-icons'>analytics</i> <span class="nav_name">Analiticas</span> </a>
			</div>
		</div>
		<a href="index.php?controller=users&amp;action=logout" class="nav_link"> <i class='material-icons'>power_settings_new</i> <span class="nav_name">SignOut</span> </a>
	</nav>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {

		const showNavbar = (toggleId, navId, bodyId, headerId) => {
			const toggle = document.getElementById(toggleId),
				nav = document.getElementById(navId),
				bodypd = document.getElementById(bodyId),
				headerpd = document.getElementById(headerId)

			// Validate that all variables exist
			if (toggle && nav && bodypd && headerpd) {
				toggle.addEventListener('click', () => {
					// show navbar
					nav.classList.toggle('show')
					// change icon
					toggle.classList.toggle('bx-x')
					// add padding to body
					bodypd.classList.toggle('body-pd')
					// add padding to header
					headerpd.classList.toggle('body-pd')
				})
			}
		}

		showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

		/*===== LINK ACTIVE =====*/
		const linkColor = document.querySelectorAll('.nav_link')

		function colorLink() {
			if (linkColor) {
				linkColor.forEach(l => l.classList.remove('active'))
				this.classList.add('active')
			}
		}
		linkColor.forEach(l => l.addEventListener('click', colorLink))
	});
</script>