<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", "Register");
?>

<?php

if (isset($errors["general"])) {
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
			<div class="login-lang kc-locale">
				<?php include(__DIR__ . "/../layouts/toggleLang.php"); ?>
			</div>
		</div>
	</div>
	<div class="bc-content">
		<div class="bc-flex-container">
			<div class="bc-msg">
				<h1 class="title">
					<span class="hide-on-mobile"><?= i18n("Register") ?></span>
				</h1>
			</div>
			<div class="login-form">
				<h4 class="form-header"></h4>

				<div class="bc-login-form">
					<form id="kc-login-form" action="index.php?controller=users&amp;action=register" method="POST">
						<div class="inputs-container">
							<div class="input-content">
								<input tabindex="1" id="email" class="input user" name="email" placeholder="<?= i18n("Put_Email") ?>" value="" type="text" autofocus="" autocomplete="off">
							</div>
							<div class="input-content">
								<input tabindex="1" id="username" class="input user" name="username" placeholder="<?= i18n("Put_Username") ?>" value="" type="text" autofocus="" autocomplete="off">
							</div>
							<div class="input-content">
								<input tabindex="2" id="password" class="input pw" name="passwd" placeholder="<?= i18n("Put_Password") ?>" type="password" autocomplete="off">
							</div>
							<div class="submit-content hide-on-mobile">
								<input tabindex="4" class="submit" name="login" id="kc-login" type="submit" value="<?= i18n("Register") ?>">
							</div>
						</div>
						<div class="inputs-container show-on-mobile">
							<div class="submit-content">
								<input tabindex="4" class="submit" name="login" id="kc-login" type="submit" value="<?= i18n("Register") ?>">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>