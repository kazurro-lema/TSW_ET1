<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Post
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

    public function __construct($id = NULL, $nombre_gasto = NULL, $cantidad_gasto = NULL, $tipo = NULL, $entidad = NULL, $fecha = NULL, $descripcion = NULL, $fichero = NULL, User $author = NULL)
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

    public function getCantidadGasto()
    {
        return $this->cantidad_gasto;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getEntidad()
    {
        return $this->entidad;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getFichero()
    {
        return $this->fichero;
    }

    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    public function validacionAñadir()
    {
        $errors = array();
        if (strlen(trim($this->nombre_gasto)) == 0) {
            $errors["nombre_gasto"] = "El nombre del gasto es obligatorio";
        }
        if (strlen(trim($this->cantidad_gasto)) == 0) {
            $errors["cantidad_gasto"] = "La cantidad del gasto es obligatorio";
        }
        if (strlen(trim($this->tipo)) == 0) {
            $errors["tipo"] = "El tipo de gasto es obligatorio";
        }
        if (strlen(trim($this->fecha)) == 0) {
            $errors["fecha"] = "La fecha es obligatorio";
        }
        if ($this->author == NULL) {
            $errors["author"] = "El autor es obligatorio";
        }

        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "EL gasto no es valido");
        }
    }

    public function validarModificacion()
    {
        $errors = array();

        if (!isset($this->id)) {
            $errors["id"] = "El id es obligatorio";
        }

        try {
            $this->validacionAñadir();
        } catch (ValidationException $ex) {
            foreach ($ex->getErrors() as $key => $error) {
                $errors[$key] = $error;
            }
        }
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "post is not valid");
        }
    }
}
