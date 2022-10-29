<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gasto = $view->getVariable("gasto");
$errors = $view->getVariable("errors");

$view->setVariable("title", "View Gasto");

?>

<h1><?= htmlentities($gasto->getNombreGasto()) ?></h1>

<p>
    <?= $gasto->getCantidadGasto() ?>
    <?= $gasto->getTipo() ?>
    <?= $gasto->getEntidad() ?>
    <?= $gasto->getFecha() ?>
    <?= $gasto->getDescripcion() ?>
    <?= $gasto->getFichero() ?>
</p>

<div class="form-button-panel">
    <button class="submit-button"><a href="index.php?controller=gastos&amp;action=edit&amp;id=<?= $gasto->getId() ?>"><?= i18n("Edit") ?></a></button>
    <button class="submit-button">
        <form method="POST" action="index.php?controller=gastos&amp;action=delete" id="delete_gasto_<?= $gasto->getId(); ?>" style="display: inline">

            <input type="hidden" name="id" value="<?= $gasto->getId() ?>">

            <a href="#" onclick="
                    if (confirm('<?= i18n("are you sure?") ?>')) {
                            document.getElementById('delete_gasto_<?= $gasto->getId() ?>').submit()
                    }"><?= i18n("Delete") ?></a>
        </form>
    </button>
</div>