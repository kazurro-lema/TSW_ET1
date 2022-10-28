<?php
//file: view/posts/view.php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gasto = $view->getVariable("gasto");
$currentuser = $view->getVariable("currentusername");
$newcomment = $view->getVariable("comment");
$errors = $view->getVariable("errors");

$view->setVariable("title", "View gasto");

?><h1><?= i18n("Gasto") . ": " . htmlentities($gasto->getNombreGasto()) ?></h1>

<p>
    <?= htmlentities($gasto->getCantidadGasto()) ?>
    <?= htmlentities($gasto->getTipo()) ?>
    <?= htmlentities($gasto->getEntidad()) ?>
    <?= htmlentities($gasto->getFecha()) ?>
    <?= htmlentities($gasto->getDescripcion()) ?>
    <?= htmlentities($gasto->getFichero()) ?>
</p>
