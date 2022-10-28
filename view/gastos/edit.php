<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gasto = $view->getVariable("gasto");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Gasto");

?><h1><?= i18n("Modify gasto")?></h1>
<form action="index.php?controller=gastos&amp;action=edit" method="POST">
    <?= i18n("nombre_gasto") ?>: <input type="text" name="nombre_gasto" value="<?= isset($_POST["nombre_gasto"])?$_POST["nombre_gasto"]:$gasto->getNombreGasto() ?>">
    <?= isset($errors["nombre_gasto"]) ? i18n($errors["nombre_gasto"]) : "" ?><br>

    <?= i18n("cantidad_gasto") ?>:<input type="text" name="cantidad_gasto" value="<?= isset($_POST["cantidad_gasto"])?$_POST["cantidad_gasto"]:$gasto->getCantidadGasto() ?>">
    <?= isset($errors["cantidad_gasto"]) ? i18n($errors["cantidad_gasto"]) : "" ?><br>

    <?= i18n("tipo") ?><select name="tipo" selected value="<?=$gasto->getTipo()?>">
					<option value="alimentacion">Alimentacion</option>
					<option value="ocio">Ocio</option>
					<option value="liquidaciones">Liquidaciones</option>
					<option value="pagos">Pagos</option>
		</select>


    <br><?= i18n("entidad") ?>:<input type="text" name="entidad" value="<?= isset($_POST["entidad"])?$_POST["entidad"]:$gasto->getEntidad() ?>">
    <?= isset($errors["entidad"]) ? i18n($errors["entidad"]) : "" ?><br>

    <?= i18n("fecha") ?>:<input type="date" name="fecha" value="<?= isset($_POST["fecha"])?$_POST["fecha"]:$gasto->getFecha() ?>">
    <?= isset($errors["fecha"]) ? i18n($errors["fecha"]) : "" ?><br>

    <?= i18n("descripcion") ?>:<textarea name="descripcion" rows="4" cols="50" value="<?= isset($_POST["descripcion"])?$_POST["descripcion"]:$gasto->getDescripcion() ?>"><?=htmlentities($gasto->getDescripcion()) ?></textarea>
    <?= isset($errors["descripcion"]) ? i18n($errors["descripcion"]) : "" ?><br>

    <?= i18n("fichero") ?><input type="text" name="fichero" value="<?= isset($_POST["fichero"])?$_POST["fichero"]:$gasto->getFichero() ?>">
    <?= isset($errors["fichero"]) ? i18n($errors["fichero"]) : "" ?><br>

    <input type="hidden" name="id" value="<?= $gasto->getId() ?>">
    <input type="submit" name="submit" value="<?= i18n("Modify gasto") ?>">
</form>
