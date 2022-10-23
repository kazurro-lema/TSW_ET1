<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Gasto.php");

class PostMapper {

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
            array_push($gastos, new Gasto($gastos["id"], $gastos["nombre_gasto"], $gastos["cantidad_gasto"], $gastos["tipo"], $gastos["entidad"], $gastos["fecha"], $gastos["descripcion"], $gastos["fichero"], $gastos["author"]));
        }
    }


	}
