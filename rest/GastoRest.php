<?php

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/UserMapper.php");

require_once(__DIR__ . "/../model/Gasto.php");
require_once(__DIR__ . "/../model/GastoMapper.php");

require_once(__DIR__ . "/BaseRest.php");


class GastoRest extends BaseRest
{
	private $gastoMapper;

	public function __construct()
	{
		parent::__construct();

		$this->gastoMapper = new gastoMapper();
	}

	public function getGastos()
	{
		$gastos = $this->gastoMapper->findAll();

		$gastos_array = array();
		foreach ($gastos as $gasto) {
			array_push($gastos_array, array(
				"id" => $gasto->getId(),
				"nombre_gasto" => $gasto->getNombreGasto(),
				"cantidad_gasto" => $gasto->getCantidadGasto(),
				"tipo" => $gasto->getTipo(),
				"entidad" => $gasto->getEntidad(),
				"fecha" => $gasto->getFecha(),
				"descripcion" => $gasto->getDescripcion(),
				"fichero" => $gasto->getFichero(),
				"author" => $gasto->getAuthor()->getusername()
			));
		}

		header($_SERVER['SERVER_PROTOCOL'] . ' 200 Ok');
		header('Content-Type: application/json');
		echo (json_encode($gastos_array));
	}

	public function createGasto($data)
	{
		$currentUser = parent::authenticateUser();
		$gasto = new Gasto();

		if (isset($data->nombre_gasto) && isset($data->cantidad_gasto) && isset($data->tipo) && isset($data->entidad) && isset($data->fecha) && isset($data->descripcion) && isset($data->fichero)) {
			$gasto->setNombreGasto($data->nombre_gasto);
			$gasto->setCantidadGasto($data->cantidad_gasto);
			$gasto->setTipo($data->tipo);
			$gasto->setEntidad($data->entidad);
			$gasto->setFecha($data->fecha);
			$gasto->setDescripcion($data->descripcion);
			$gasto->setFichero($data->fichero);
			$gasto->setAuthor($currentUser);
		}

		try {
			$gasto->checkIsValidForCreate();

			$gastoId = $this->gastoMapper->save($gasto);

			header($_SERVER['SERVER_PROTOCOL'] . ' 201 Created');
			header('Location: ' . $_SERVER['REQUEST_URI'] . "/" . $gastoId);
			header('Content-Type: application/json');
			echo (json_encode(array(
				"id" => $gastoId,
				"nombre_gasto" => $gasto->getNombreGasto(),
				"cantidad_gasto" => $gasto->getCantidadGasto(),
				"tipo" => $gasto->getTipo(),
				"entidad" => $gasto->getEntidad(),
				"fecha" => $gasto->getFecha(),
				"descripcion" => $gasto->getDescripcion(),
				"fichero" => $gasto->getFichero()
			)));
		} catch (ValidationException $e) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad request');
			header('Content-Type: application/json');
			echo (json_encode($e->getErrors()));
		}
	}

	public function readGasto($gastoId)
	{
		$gasto = $this->gastoMapper->findById($gastoId);
		if ($gasto == NULL) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad request');
			echo ("Gasto with id " . $gastoId . " not found");
			return;
		}

		$gasto_array = array(
			"id" => $gasto->getId(),
			"nombre_gasto" => $gasto->getNombreGasto(),
			"cantidad_gasto" => $gasto->getCantidadGasto(),
			"tipo" => $gasto->getTipo(),
			"entidad" => $gasto->getEntidad(),
			"fecha" => $gasto->getFecha(),
			"descripcion" => $gasto->getDescripcion(),
			"fichero" => $gasto->getFichero(),
			"author" => $gasto->getAuthor()->getusername()

		);


		header($_SERVER['SERVER_PROTOCOL'] . ' 200 Ok');
		header('Content-Type: application/json');
		echo (json_encode($gasto_array));
	}

	public function updateGasto($gastoId, $data)
	{
		$currentUser = parent::authenticateUser();

		$gasto = $this->gastoMapper->findById($gastoId);
		if ($gasto == NULL) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad request');
			echo ("gasto with id " . $gastoId . " not found");
			return;
		}

		if ($gasto->getAuthor() != $currentUser) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
			echo ("you are not the author of this gasto");
			return;
		}

		$gasto->setNombreGasto($data->nombre_gasto);
		$gasto->setCantidadGasto($data->cantidad_gasto);
		$gasto->setTipo($data->tipo);
		$gasto->setEntidad($data->entidad);
		$gasto->setFecha($data->fecha);
		$gasto->setDescripcion($data->descripcion);
		$gasto->setFichero($data->fichero);

		try {
			$gasto->checkIsValidForUpdate();
			$this->gastoMapper->update($gasto);
			header($_SERVER['SERVER_PROTOCOL'] . ' 200 Ok');
		} catch (ValidationException $e) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad request');
			header('Content-Type: application/json');
			echo (json_encode($e->getErrors()));
		}
	}

	public function deleteGasto($gastoId)
	{
		$currentUser = parent::authenticateUser();
		$gasto = $this->gastoMapper->findById($gastoId);

		if ($gasto == NULL) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad request');
			echo ("gasto with id " . $gastoId . " not found");
			return;
		}

		if ($gasto->getAuthor() != $currentUser) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
			echo ("you are not the author of this post");
			return;
		}

		$this->gastoMapper->delete($gasto);

		header($_SERVER['SERVER_PROTOCOL'] . ' 204 No Content');
	}
}

$gastoRest = new GastoRest();
URIDispatcher::getInstance()
	->map("GET",	"/gasto", array($gastoRest, "getGastos"))
	->map("GET",	"/gasto/$1", array($gastoRest, "readGasto"))
	->map("POST", "/gasto", array($gastoRest, "createGasto"))
	->map("PUT",	"/gasto/$1", array($gastoRest, "updateGasto"))
	->map("DELETE", "/gasto/$1", array($gastoRest, "deleteGasto"));
