<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$user = $view->getVariable("currentuser");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Current user");

?>

<h1><?= htmlentities($user->getUsername()) ?></h1>

<p>
    <?= $user->getEmail() ?>
    <?= $user->getPasswd() ?>
</p>

<div class="form-button-panel">
    <button class="submit-button">
        <form method="POST" action="index.php?controller=users&amp;action=delete" id="delete_gasto_<?= $user->getUsername(); ?>" style="display: inline">

            <input type="hidden" name="id" value="<?= $user->getUsername() ?>">

            <a href="#" onclick="
                    if (confirm('<?= i18n("are you sure?") ?>')) {
                            document.getElementById('delete_gasto_<?= $user->getUsername() ?>').submit()
                    }"><?= i18n("Delete") ?></a>
        </form>
    </button>
</div>