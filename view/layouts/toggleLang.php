<toggle-language>
	<div class="toggle-language">
		<span class="mat-menu-trigger lang-selector 
				<?php echo $_SESSION["__currentlang__"] === 'es' ? "current-content-language" : "current-alternative-language"; ?>" aria-label="Content language">ES</span>

		<button class="mat-icon-button" id="toggleLang">
			<span class="mat-button-wrapper">
				<mat-icon class="material-icons">sync_alt</mat-icon>
			</span>
		</button>

		<span class="mat-menu-trigger lang-selector 
				<?php echo $_SESSION["__currentlang__"] === 'en' ? "current-content-language" : "current-alternative-language"; ?>">EN</span>
	</div>
</toggle-language>