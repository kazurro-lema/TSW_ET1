<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/Gasto.php");
require_once(__DIR__ . "/../model/ChartFilters.php");

class GastoMapper
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

		foreach ($gastos_db as $gasto) {
			$author = new User($gasto["username"]);
			array_push($gastos, new Gasto(
				$gasto["id"],
				$gasto["nombre_gasto"],
				$gasto["cantidad_gasto"],
				$gasto["tipo"],
				$gasto["entidad"],
				$gasto["fecha"],
				$gasto["descripcion"],
				$gasto["fichero"],
				$author
			));
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
			return NULL;
		}
	}

	public function findByAuthor($gastoAuthor)
	{
		$stmt = $this->db->query("SELECT * FROM gastos, users WHERE users.username = gastos.author ORDER BY fecha DESC");
		$gastos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$gastos = array();

		foreach ($gastos_db as $gasto) {

			$author = new User($gasto["username"]);
			if ($author == $gastoAuthor) {
				array_push($gastos, new Gasto(
					$gasto["id"],
					$gasto["nombre_gasto"],
					$gasto["cantidad_gasto"],
					$gasto["tipo"],
					$gasto["entidad"],
					$gasto["fecha"],
					$gasto["descripcion"],
					$gasto["fichero"],
					$author
				));
			}
		}

		return $gastos;
	}

	public function findByAuthorFiltered($gastoAuthor, $fechaIni = null, $fechaFin = null)
	{
		$filtros = '';

		if (isset($fechaIni) && !empty($fechaIni)) {
			$filtros = $filtros . "fecha >= '" . $fechaIni . "' and ";
		}

		if (isset($fechaFin) && !empty($fechaFin)) {
			$filtros = $filtros . "fecha <= '" . $fechaFin . "' and ";
		}

		$stmt = $this->db->query("SELECT * FROM gastos, users WHERE $filtros users.username = gastos.author ORDER BY fecha DESC");
		$gastos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$gastos = array();

		foreach ($gastos_db as $gasto) {

			$author = new User($gasto["username"]);
			if ($author == $gastoAuthor) {
				array_push($gastos, new Gasto(
					$gasto["id"],
					$gasto["nombre_gasto"],
					$gasto["cantidad_gasto"],
					$gasto["tipo"],
					$gasto["entidad"],
					$gasto["fecha"],
					$gasto["descripcion"],
					$gasto["fichero"],
					$author
				));
			}
		}

		return $gastos;
	}

	public function getChartsFilters($fechaIni = null, $fechaFin = null)
	{
		$filters = array();

		array_push($filters, new ChartFilters(
			$fechaIni,
			$fechaFin
		));

		return $filters;
	}

	public function save(Gasto $gasto)
	{
		$stmt = $this->db->prepare("INSERT INTO gastos(nombre_gasto, cantidad_gasto, tipo, entidad, fecha, descripcion, fichero, author) values (?,?,?, ?, ?, ?, ?, ?)");
		$stmt->execute(array(
			$gasto->getNombreGasto(),
			$gasto->getCantidadGasto(),
			$gasto->getTipo(),
			$gasto->getEntidad(),
			$gasto->getFecha(),
			$gasto->getDescripcion(),
			$gasto->getFichero(),
			$gasto->getAuthor()->getUsername()
		));

		return $this->db->lastInsertId();
	}

	public function update(Gasto $gasto)
	{
		$stmt = $this->db->prepare("UPDATE gastos set nombre_gasto=?, cantidad_gasto=?, tipo=?, entidad=?, fecha=?, descripcion=?, fichero=? where id=?");
		$stmt->execute(array(
			$gasto->getNombreGasto(),
			$gasto->getCantidadGasto(),
			$gasto->getTipo(),
			$gasto->getEntidad(),
			$gasto->getFecha(),
			$gasto->getDescripcion(),
			$gasto->getFichero(),
			$gasto->getId()
		));
	}

	public function delete(Gasto $gasto)
	{
		$stmt = $this->db->prepare("DELETE from gastos WHERE id=?");
		$stmt->execute(array($gasto->getId()));
	}

	public function descargar($gastoAuthor)
	{
		$query = $this->db->query("SELECT * FROM gastos, users WHERE users.username = gastos.author ORDER BY fecha DESC");

		$gastos_db = $query->fetchAll(PDO::FETCH_ASSOC);

		header('Content-type: aplication/vnd.ms-excel');
		header('Content-Disposition: attachement; filename=hioa.csv');
		header('Pragma: no-cache');
		header('Expires: 0');
		echo "nombre_gasto;cantidad_gasto;tipo;entidad;fecha;descripcion;fichero<br>";

		foreach ($gastos_db as $gasto) {

			$author = new User($gasto["username"]);
			if ($author == $gastoAuthor) {
				
					echo '<tr>';
					echo '<td>'.$gasto["nombre_gasto"].'</td>';
					echo '<td>'.$gasto["cantidad_gasto"].'</td>';
					echo '<td>'.$gasto["tipo"].'</td>';
					echo '<td>'.$gasto["entidad"].'</td>';
					echo '<td>'.$gasto["fecha"].'</td>';
					echo '<td>'.$gasto["descripcion"].'</td>';
					echo '<td>'.$gasto["fichero"].'</td>';
					echo '</tr>';
			}
		}

		echo '<table>';

	}
}
