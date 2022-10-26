<?php
//file: view/users/login.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>

<?php

	if(isset($errors["general"])){
		$x = $errors['general'];
		echo "<script type='text/javascript'>alert('$x')</script>";
	}
	
?>

<div class="login-page">
	<div class="login-header">
		<div class="bc-logo">
			<img src="/login/auth/resources/vnghb/login/biccloud/img/bic-cloud-logo-login.png">
		</div>
		<div class="bc-navigation">
			<div class="login-lang kc-locale hide-on-mobile">
				<div class="lang-dropdown">
					<a href="#" id="selected-lang" class="selected-locale">English</a>
					<ul id="lang-list" style="display: none;">
						<li class="kc-dropdown-item">
							<a href="/login/auth/realms/grc/login-actions/authenticate?client_id=bicexec-authentication&amp;tab_id=pEJAmV2rbaI&amp;execution=893e9dea-23ed-4c57-aa07-3d1c368dec2c&amp;kc_locale=de">Deutsch</a>
						</li>
						<li class="kc-dropdown-item">
							<a href="/login/auth/realms/grc/login-actions/authenticate?client_id=bicexec-authentication&amp;tab_id=pEJAmV2rbaI&amp;execution=893e9dea-23ed-4c57-aa07-3d1c368dec2c&amp;kc_locale=en">English</a>
						</li>
						<li class="kc-dropdown-item">
							<a href="/login/auth/realms/grc/login-actions/authenticate?client_id=bicexec-authentication&amp;tab_id=pEJAmV2rbaI&amp;execution=893e9dea-23ed-4c57-aa07-3d1c368dec2c&amp;kc_locale=es">Español</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="bc-content">
		<div class="bc-flex-container">
			<div class="bc-msg">
				<h1 class="title">
					<span class="hide-on-mobile">Aquí ponemos cosinhas </span>
				</h1>
				<h2 class="subtitle">a</h2>
			</div>
			<div class="login-form">
				<h4 class="form-header"></h4>

				<div class="bc-login-form">
					<form id="kc-login-form" action="index.php?controller=users&amp;action=login" method="POST">
						<div class="inputs-container">
							<div class="input-content">
								<input tabindex="1" id="username" class="input user" name="username" placeholder="<?= i18n("Put_Username") ?>" value="" type="text" autofocus="" autocomplete="off">
							</div>
							<div class="input-content">
								<input tabindex="2" id="password" class="input pw" name="passwd" placeholder="<?= i18n("Put_Password") ?>" type="password" autocomplete="off">
							</div>
							<div class="submit-content hide-on-mobile">
								<input tabindex="4" class="submit" name="login" id="kc-login" type="submit" value="<?= i18n("Login") ?>">
							</div>
						</div>
						<div class="bc-form-options">
							<span class="forgot-pass">
								<?= i18n("Not user?") ?> <a href="index.php?controller=users&amp;action=register"><?= i18n("Register here!") ?></a>
							</span>
						</div>
						<div class="inputs-container show-on-mobile">
							<div class="submit-content">
								<input tabindex="4" class="submit" name="login" id="kc-login" type="submit" value="<?= i18n("Login") ?>">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function showLabelInputsForm() {
		var inputsText = document.querySelectorAll(".login-form input");
		for (const inputText of inputsText) {
			if (inputText.type === "text" || inputText.type === "password") {
				_showLabel(inputText);
				inputText.addEventListener("keyup", function(e) {
					_showLabel(e.target);
				});
			}
		}

		function _showLabel(selector) {
			if (selector.value === "") {
				selector.parentElement.getElementsByTagName("label")[0].className = "label-input hidden";
			} else {
				selector.parentElement.getElementsByTagName("label")[0].className = "label-input";
			}
		}
	}
</script>