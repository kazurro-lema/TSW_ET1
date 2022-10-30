<?php

require_once(__DIR__ . "/../model/Gasto.php");
require_once(__DIR__ . "/../model/GastoMapper.php");
require_once(__DIR__ . "/../model/User.php");

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class GastosController extends BaseController
{
	private $gastoMapper;

	public function __construct()
	{
		parent::__construct();
		$this->gastoMapper = new GastoMapper();
	}

	public function index()
	{
		$gastos = $this->gastoMapper->findByAuthor($this->currentUser);
		$this->view->setVariable("gastos", $gastos);
		$this->view->render("gastos", "index");
	}

	public function view()
	{
		if (!isset($_GET["id"])) {
			throw new Exception("Id is mandatory");
		}

		$gastoid = $_REQUEST["id"];
		$gasto = $this->gastoMapper->findById($gastoid);

		$this->view->setVariable("gasto", $gasto);

		$this->view->render("gastos", "view");
	}

	public function add()
	{
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding gastos requires login");
		}

		$gasto = new Gasto();

		if (isset($_POST["submit"])) {
			$gasto->setNombreGasto($_POST["nombre_gasto"]);
			$gasto->setCantidadGasto($_POST["cantidad_gasto"]);
			$gasto->setTipo($_POST["tipo"]);
			$gasto->setEntidad($_POST["entidad"]);
			$gasto->setFecha($_POST["fecha"]);
			$gasto->setDescripcion($_POST["descripcion"]);
			$gasto->setFichero($_POST["fichero"]);
			$gasto->setAuthor($this->currentUser);

			try {
				$gasto->checkIsValidForCreate();

				$this->gastoMapper->save($gasto);

				$this->view->setFlash(sprintf(i18n("Gastos \"%s\" successfully added."), $gasto->getNombreGasto()));

				$this->view->redirect("gastos", "index");
			} catch (ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}

		$this->view->setVariable("gasto", $gasto);
		$this->view->render("gastos", "add");
	}

	public function edit()
	{
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A gasto id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing gastos requires login");
		}

		$gastoid = $_REQUEST["id"];
		$gasto = $this->gastoMapper->findById($gastoid);

		if ($gasto == NULL) {
			throw new Exception("no such gasto with id: " . $gastoid);
		}

		if ($gasto->getAuthor() != $this->currentUser) {
			throw new Exception("logged user is not the author of the gasto id " . $gastoid);
		}

		if (isset($_POST["submit"])) {

			$gasto->setNombreGasto($_POST["nombre_gasto"]);
			$gasto->setCantidadGasto($_POST["cantidad_gasto"]);
			$gasto->setTipo($_POST["tipo"]);
			$gasto->setEntidad($_POST["entidad"]);
			$gasto->setFecha($_POST["fecha"]);
			$gasto->setDescripcion($_POST["descripcion"]);
			$gasto->setFichero($_POST["fichero"]);
			$gasto->setAuthor($this->currentUser);

			try {
				$gasto->checkIsValidForUpdate();
				$this->gastoMapper->update($gasto);

				$this->view->setFlash(sprintf(i18n("Gastos \"%s\" successfully updated."), $gasto->getNombreGasto()));

				$this->view->redirect("gastos", "index");
			} catch (ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}

		$this->view->setVariable("gasto", $gasto);

		$this->view->render("gastos", "edit");
	}

	public function delete()
	{
		if (!isset($_POST["id"])) {
			throw new Exception("id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing gastos requires login");
		}

		$gastoid = $_REQUEST["id"];
		$gasto = $this->gastoMapper->findById($gastoid);

		if ($gasto == NULL) {
			throw new Exception("no such gasto with id: " . $gastoid);
		}

		if ($gasto->getAuthor() != $this->currentUser) {
			throw new Exception("Gasto author is not the logged user");
		}

		$this->gastoMapper->delete($gasto);

		$this->view->setFlash(sprintf(i18n("Gasto \"%s\" successfully deleted."), $gasto->getNombreGasto()));

		$this->view->redirect("gastos", "index");
	}

	public function charts()
	{
		if (!isset($_POST["fechaIni"])) {
			$_POST["fechaIni"] = "";
		}

		if (!isset($_POST["fechaFin"])) {
			$_POST["fechaFin"] = "";
		}

		$filters = $this->gastoMapper->getChartsFilters($_POST["fechaIni"], $_POST["fechaFin"]);
		$gastos = $this->gastoMapper->findByAuthorFiltered($this->currentUser, $_POST["fechaIni"], $_POST["fechaFin"]);
		$gastosOnLast12Months = $this->gastoMapper->findByAuthorFiltered($this->currentUser, $_POST["fechaIni"], $_POST["fechaFin"]);

		$this->view->setVariable("filters", $filters);
		$this->view->setVariable("gastos", $gastos);
		$this->view->setVariable("gastosOnLast12Months", $gastosOnLast12Months);
		$this->view->render("gastos", "charts");
	}

	public function descarga()
	{
		header('Content-Type: text/csv; charset=UTF-8');
		header('Content-Disposition: attachment; filename=data.csv');

		fputcsv()
	}
}

