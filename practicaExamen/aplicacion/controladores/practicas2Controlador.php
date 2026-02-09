<?php

class practicas2Controlador extends CControlador
{
	public array $menuizq = [];
	public array $menuhead = [];
	public function __construct() {}

	public function accionIndex()
	{
		$this->menuhead = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practicas 2",
				"enlace" => ["practicas2/index"]
			]
		];
		$this->menuizq = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practicas 2",
				"enlace" => ["practicas2/index"]
			],
			[
				"texto" => "Descarga 1",
				"enlace" => ["practicas2/descarga1"]
			],
			[
				"texto" => "Peticion Ajax",
				"enlace" => ["practicas2/ajax"]
			]
		];
		$this->dibujaVista(
			"index",
			[],
			"Index"
		);
	}
	public function accionMierror()
	{
		Sistema::app()->paginaError(404, "No seas malo y no accedas a esta pagina");
	}
	public function accionDescarga1()
	{
		$this->menuhead = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practica 2",
				"enlace" => ["practicas2/index"]
			],
			[
				"texto" => "Descarga 1",
				"enlace" => ["practicas2/descarga1"]
			]
		];
		$this->dibujaVista(
			"descarga1",
			[],
			"Descarga 1"
		);
	}
	public function accionDescarga2()
	{
		$archivo = __DIR__ . "/../../imagenes/alberto-chicote-instagram.jpeg";
		if (file_exists($archivo)) {
			header("Content-Type: image/jpeg");
			header('Content-Disposition: attachment; filename="' . basename($archivo) . '"');
			readfile($archivo);
			exit;
		}
	}
	public function accionPedirDatos()
	{
		$min = isset($_GET["min"]) ? (int)$_GET["min"] : 1;
		$max = isset($_GET["max"]) ? (int)$_GET["max"] : 10;
		$patron = isset($_GET["patron"]) ? $_GET["patron"] : "macarron";
		$numeros = [];
		for ($i = 0; $i <= 10; $i++) {
			$numeros[$i] = mt_rand($min, $max);
		}
		$palabras = [];
		$longitud = mb_strlen($patron);
		$primer = mb_substr($patron, 0, 1);
		$ultimo = mb_substr($patron, $longitud - 1, 1);
		for ($i = 0; $i < 10; $i++) {
			$medio = "";
			for ($j = 0; $j < $longitud - 2; $j++) {
				$medio .= chr(rand(97, 122));
			}
			$palabras[$i] = $primer . $medio . $ultimo;
		}
		$salida = [
			"numeros" => $numeros,
			"palabras" => $palabras
		];
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($salida);
		exit;
	}
	public function accionPeticionAjax()
	{
		$this->menuhead = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practica 2",
				"enlace" => ["practicas2/index"]
			],
			[
				"texto" => "Peticion Ajax",
				"enlace" => ["practicas2/ajax"]
			]
		];
		$this->dibujaVista(
			"ajax",
			[],
			"Peticion Ajax"
		);
	}
}
