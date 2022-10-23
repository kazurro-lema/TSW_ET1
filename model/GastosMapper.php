<?php
require_once(__DIR__ . "/../core/PDOConnection.php");

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/Gasto.php");

class PostMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function findAll()
    {
        $stmt = $this->db->query("SELECT * FROM gastos, users WHERE users.username = gastos.author");
        $gastos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $gastos = array();

        foreach ($gastos_db as $gastos) {
            $author = new User($gastos["username"]);
            array_push($gastos, new Gasto($gastos["id"], $gastos["nombre_gasto"], $gastos["cantidad_gasto"], $gastos["tipo"], $gastos["entidad"], $gastos["fecha"], $gastos["descripcion"], $gastos["fichero"], $author));
        }

        return $gastos;
    }

    public function findById($gastoid)
    {
        $stmt = $this->db->prepare("SELECT * FROM gastos WHERE id=?");
        $stmt->execute(array($gastoid));
        $gasto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gasto != null) {
            return new Gasto(
                $gasto["id"],
                $gasto["nombre_gasto"],
                $gasto["cantidad_gasto"],
                $gasto["tipo"],
                $gasto["entidad"],
                $gasto["fecha"],
                $gasto["descripcion"],
                $gasto["fichero"],
                new User($gasto["author"])
            );
        } else {
            return null;
        }
    }

    public function save(Gasto $gasto)
    {
        $stmt = $this->db->prepare("INSERT INTO gastos(nombre_gasto, cantidad_gasto, tipo, entidad, fecha, descripcion, fichero, author) values (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute(array($gasto->getNombreGasto(), $gasto->getCantidadGasto(), $gasto->getTipo(), $gasto->getEntidad(), $gasto->getFecha(), $gasto->getDescripcion(), $gasto->getFichero(), $gasto->getAuthor()->getUsername()));
        return $this->db->lastInsertId(); //no se donde esta esta funcion
    }

    public function udpate(Gasto $gasto)
    {
        $stmt = $this->db->prepare("UPDATE gastos set nombre_gasto, cantidad_gasto, tipo, entidad, fecha, descripcion, fichero, author where id=?");
        $stmt->execute(array($gasto->getNombreGasto(), $gasto->getCantidadGasto(), $gasto->getTipo(), $gasto->getEntidad(), $gasto->getFecha(), $gasto->getDescripcion(), $gasto->getFichero(), $gasto->getAuthor()->getUsername()));
    }

    public function delete(Gasto $gasto)
    {
        $stmt = $this->db->prepare("DELETE from gastos WHERE id=?");
        $stmt->execute(array($gasto->getId()));
    }
}
