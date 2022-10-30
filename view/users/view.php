<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$user = $view->getVariable("currentuser");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Current user");

?>
<card-form>
    <mat-card class="mat-card">
        <mat-card-header class="mat-card-header card-title">
            <?= htmlentities($user->getUsername()) ?>
        </mat-card-header>
        <card-fieldset>
                <section>
                    <form-element style="flex: 1 1 100%;">
                        <label class="label" for="username"><?= i18n("username") ?></label>
                        <input type="text" name="username" value="<?= $user->getUsername() ?>" disabled>
                    </form-element>

                    <form-element style="flex: 1 1 33.33%;">
                        <label class="label" for="email"><?= i18n("email") ?></label>
                        <input type="text" name="email" value="<?= $user->getEmail() ?>" disabled>
                    </form-element>

                    <form-element style="flex: 1 1 33.33%;">
                        <label class="label" for="password"><?= i18n("password") ?></label>
                        <input type="password" name="email" value="<?= $user->getEmail() ?>" disabled>
                    </form-element>
                    <div class="form-button-panel">
                        <button class="submit-button">
                            <form method="POST" action="index.php?controller=users&amp;action=delete" id="delete_gasto_<?= $user->getUsername(); ?>" style="display: inline">

                                <input type="hidden" name="id" value="<?= $user->getUsername() ?>">

                                <a href="#" onclick="
                                    if (confirm('<?= i18n("are you sure?") ?>')) {
                                            document.getElementById('delete_gasto_<?= $user->getUsername() ?>').submit()
                                    }"><?= i18n("Delete") ?>
                                </a>
                            </form>
                        </button>
                    </div>
                </section>
        </card-fieldset>
    </mat-card>


</card-form>