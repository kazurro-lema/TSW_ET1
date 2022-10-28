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
        $gastos = $this->gastoMapper->findAll();
        $this->view->setVariable("gastos", $gastos);
        $this->view->render("gastos", "index");
    }

    public function view()
    {
        if (!isset($_GET["id"])) {
            throw new Exception("Id is mandatory");
        }

        $this->view->render("gastos", "view");
    }

    public function add()
    {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Adding posts requires login");
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

                $this->view->setFlash(sprintf(i18n("Post \"%s\" successfully added."), $gasto->getNombreGasto()));

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
			throw new Exception("Not in session. Editing posts requires login");
		}

		$gastoid = $_REQUEST["id"];
		$gasto = $this->gastoMapper->findById($gastoid);

        if ($gasto == NULL) {
			throw new Exception("no such post with id: ".$gastoid);
		}

		if ($gasto->getAuthor() != $this->currentUser) {
			throw new Exception("logged user is not the author of the post id ".$gastoid);
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

				$this->view->setFlash(sprintf(i18n("Post \"%s\" successfully updated."),$gasto ->getNombreGasto()));

				$this->view->redirect("gastos", "index");

			}catch(ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}

        $this->view->setVariable("gasto", $gasto);

		$this->view->render("gastos", "edit");
    }

    public function delete() {
		if (!isset($_POST["id"])) {
			throw new Exception("id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing posts requires login");
		}
		
		$gastoid = $_REQUEST["id"];
		$gasto = $this->gastoMapper->findById($gastoid);

		if ($gasto == NULL) {
			throw new Exception("no such post with id: ".$gastoid);
		}

		if ($gasto->getAuthor() != $this->currentUser) {
			throw new Exception("Post author is not the logged user");
		}

		$this->gastoMapper->delete($gasto);

		$this->view->setFlash(sprintf(i18n("Post \"%s\" successfully deleted."),$gasto ->getNombreGasto()));

		$this->view->redirect("gastos", "index");

	}
}
