<?php

	$es = "current-content-language";
	$en = "current-alternative-language";

	if(isset($_SESSION['__currentlang__']) && !empty($_SESSION['__currentlang__']) && $_SESSION["__currentlang__"] === 'en'){
		$es = "current-alternative-language"; 
		$en = "current-content-language"; 
	}

?>

<toggle-language>
	<div class="toggle-language">
		<span class="mat-menu-trigger lang-selector <?php echo $es; ?>" aria-label="Content language">ES</span>

		<button class="mat-icon-button" id="toggleLang">
			<span class="mat-button-wrapper">
				<mat-icon class="material-icons">sync_alt</mat-icon>
			</span>
		</button>

		<span class="mat-menu-trigger lang-selector <?php echo $en; ?>">EN</span>
	</div>
</toggle-language>