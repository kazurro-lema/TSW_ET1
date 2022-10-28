<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Gasto
{
    private $id;
    private $nombre_gasto;
    private $cantidad_gasto;
    private $tipo;
    private $entidad;
    private $fecha;
    private $descripcion;
    private $fichero;
    private $author;

    public function __construct($id = null, $nombre_gasto = null, $cantidad_gasto = null, $tipo = null, $entidad = null, $fecha = null, $descripcion = null, $fichero = null, User $author = null)
    {
        $this->id = $id;
        $this->nombre_gasto = $nombre_gasto;
        $this->cantidad_gasto = $cantidad_gasto;
        $this->tipo = $tipo;
        $this->entidad = $entidad;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->fichero = $fichero;
        $this->author = $author;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreGasto()
    {
        return $this->nombre_gasto;
    }

    public function setNombreGasto($nombre_gasto)
    {
        $this->nombre_gasto = $nombre_gasto;
    }

    public function getCantidadGasto()
    {
        return $this->cantidad_gasto;
    }

    public function setCantidadGasto($cantidad_gasto)
    {
        $this->cantidad_gasto = $cantidad_gasto;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getEntidad()
    {
        return $this->entidad;
    }

    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getFichero()
    {
        return $this->fichero;
    }

    public function setFichero($fichero)
    {
        $this->fichero = $fichero;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    public function checkIsValidForCreate()
    {
        $errors = array();
        if (strlen(trim($this->nombre_gasto)) == 0) {
            $errors["nombre_gasto"] = "nombre_gasto is mandatory";
        }
        if (strlen(trim($this->cantidad_gasto)) == 0) {
            $errors["cantidad_gasto"] = "cantidad_gasto is mandatory";
        }
        if (strlen(trim($this->tipo)) == 0) {
            $errors["tipo"] = "tipo is mandatory";
        }
        if (strlen(trim($this->fecha)) == 0) {
            $errors["fecha"] = "fecha is mandatory";
        }
        if ($this->author == NULL) {
            $errors["author"] = "author is mandatory";
        }
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "gastos is not valid");
        }
    }

    public function checkIsValidForUpdate()
    {
        $errors = array();

        if (!isset($this->id)) {
            $errors["id"] = "id is mandatory";
        }
        try {
            $this->checkIsValidForCreate();
        } catch (ValidationException $th) {
            foreach ($th->getErrors() as $key => $error) {
                $errors[$key] = $error;
            }
        }

        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "gasto is not valid");
        }
    }
}
