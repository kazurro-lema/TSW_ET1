<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class ChartFilters
{
	private $fechaIni;
	private $fechaFin;

	public function __construct($fechaIni = null, $fechaFin = null)
	{
		$this->fechaIni = $fechaIni;
		$this->fechaFin = $fechaFin;
	}

	public function getFechaIni()
	{
		return $this->fechaIni;
	}

	public function setFechaIni($fechaIni)
	{
		$this->fechaIni = $fechaIni;
	}

	public function getFechaFin()
	{
		return $this->fechaFin;
	}

	public function setFechaFin($fechaFin)
	{
		$this->fechaFin = $fechaFin;
	}
}
