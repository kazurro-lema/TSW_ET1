<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gasto = $view->getVariable("gasto");
$currentuser = $view->getVariable("currentusername");
$errors = $view->getVariable("errors");

$view->setVariable("title", "View gasto");

?><h1><?= i18n("Gasto") . ": " . htmlentities($gasto->getNombreGasto()) ?></h1>
