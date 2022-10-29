<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gastos = $view->getVariable("gastos");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "Gastos");

?><h1><?= i18n("Gastos") ?></h1>
<table border="1">
    <tr>
        <th><?= i18n("nombre_gasto") ?></th>
        <th><?= i18n("cantidad_gasto") ?></th>
        <th><?= i18n("tipo") ?></th>
        <th><?= i18n("entidad") ?></th>
        <th><?= i18n("fecha") ?></th>
        <th><?= i18n("descripcion") ?></th>
        <th><?= i18n("fichero") ?></th>
    </tr>

    <?php foreach ($gastos as $gasto) : ?>
        <?php
        if (isset($currentuser) && $currentuser == $gasto->getAuthor()->getUsername()) : ?>
            <tr>
                <td>
                    <a href="index.php?controller=gastos&amp;action=view&amp;id=<?= $gasto->getId() ?>"><?= htmlentities($gasto->getNombreGasto()) ?></a>
                </td>
                <td>
                    <?= $gasto->getCantidadGasto() ?>
                </td>
                <td>
                    <?= $gasto->getTipo() ?>
                </td>
                <td>
                    <?= $gasto->getEntidad() ?>
                </td>
                <td>
                    <?= $gasto->getFecha() ?>
                </td>
                <td>
                    <?= $gasto->getDescripcion() ?>
                </td>
                <td>
                    <?= $gasto->getFichero() ?>
                </td>
                <td>

                    <?php
                    ?>
                    <form method="POST" action="index.php?controller=gastos&amp;action=delete" id="delete_gasto_<?= $gasto->getId(); ?>" style="display: inline">

                        <input type="hidden" name="id" value="<?= $gasto->getId() ?>">

                        <a href="#" onclick="
				if (confirm('<?= i18n("are you sure?") ?>')) {
					document.getElementById('delete_gasto_<?= $gasto->getId() ?>').submit()
				}"><?= i18n("Delete") ?></a>
                    </form>

                    &nbsp;

                    <?php
                    ?>
                    <a href="index.php?controller=gastos&amp;action=edit&amp;id=<?= $gasto->getId() ?>"><?= i18n("Edit") ?></a>


                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>