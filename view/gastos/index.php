<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gastos = $view->getVariable("gastos");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "Gastos");

?><h1><?= i18n("Gastos") ?></h1>
<table border="1">
    <tr>
        <th><?= i18n("Nombre_gasto") ?></th>
        <th><?= i18n("Cantidad_gasto") ?></th>
        <th><?= i18n("Tipo") ?></th>
        <th><?= i18n("Entidad") ?></th>
        <th><?= i18n("Fecha") ?></th>
        <th><?= i18n("Descripcion") ?></th>
        <th><?= i18n("Fichero") ?></th>
    </tr>

    <?php foreach ($gastos as $gasto) : ?>
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
                if (isset($currentuser) && $currentuser == $gasto->getAuthor()->getUsername()) : ?>
                    <?php
                    ?>
                    <form method="POST" action="index.php?controller=gastos&amp;action=delete" id="delete_gasto_<?= $gasto->getId(); ?>" style="display: inline">

                        <input name="id" value="<?= $gasto->getId() ?>">

                        <a href="#" onclick="
				if (confirm('<?= i18n("are you sure?") ?>')) {
					document.getElementById('delete_post_<?= $gasto->getId() ?>').submit()
				}"><?= i18n("Delete") ?></a>
                    </form>

                    &nbsp;

                    <?php
                    // 'Edit Button'
                    ?>
                    <a href="index.php?controller=gastos&amp;action=edit&amp;id=<?= $gasto->getId() ?>"><?= i18n("Edit") ?></a>

                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
