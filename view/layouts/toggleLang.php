<toggle-language>
	<div class="toggle-language">
		<span class="mat-menu-trigger lang-selector 
				<?php echo $_SESSION["__currentlang__"] === 'es' ? "current-content-language" : "current-alternative-language"; ?>" aria-label="Content language">ES</span>

		<button class="mat-focus-indicator mat-tooltip-trigger mat-icon-button mat-button-base" id="toggleLang">
			<span class="mat-button-wrapper">
				<mat-icon class="mat-icon notranslate material-icons mat-icon-no-color">sync_alt</mat-icon>
			</span>
		</button>

		<span class="mat-menu-trigger lang-selector 
				<?php echo $_SESSION["__currentlang__"] === 'en' ? "current-content-language" : "current-alternative-language"; ?>">EN</span>
	</div>
</toggle-language>