<?php

final class practicas2Controlador extends CControlador
{
	public array $menu = [];
	public array $menuizq = [];
	public array $barraUbi = [];
	public array $actual = [];

	public function __construct()
	{
		$this->menu = require __DIR__ . "/../config/menu.php";
		$this->menuizq = $this->menu['practicas2']['hijos'];
	}

	public function accionIndex()
	{

		$this->barraUbi = $this->menu;
		$this->actual = $this->menu["practicas2"];

		$this->dibujaVista(
			"index",
			[],
			"Prácticas 2"
		);
	}

	public function accionMierror()
	{
		Sistema::app()->paginaError(404, "No seas malo y no accedas a esta página");
	}

	public function accionDescarga1()
	{

		$this->barraUbi = $this->menu;
		$this->actual = $this->menu["practicas2"]['hijos']['descarga1'];

		$this->dibujaVista(
			"descarga1",
			[],
			"Descarga 1"
		);
	}

	public function accionDescarga2()
	{

		$archivo = __DIR__ . "/../../imagenes/chicotetactico.jpg";

		if (file_exists($archivo)) {
			header('Content-Type: image/jpeg');
			header('Content-Disposition: attachment; filename="' . basename($archivo) . '"');

			readfile($archivo);
			exit;
		}
	}

	public function accionPedirDatos()
	{

		$min = $_GET['min'] ?? 1;
		$max = $_GET['max'] ?? 10;
		$patron = $_GET['patron'] ?? "hoola";

		$array = [];
		$numeros = [];
		$palabras = [];

		for ($i = 0; $i < 10; $i++) {
			$numeros[$i] = mt_rand($min, $max);
		}

		$longitud = strlen($patron);

		for ($i = 0; $i < 10; $i++) {
			$aleatoria = "";
			for ($j = 0; $j < $longitud - 2; $j++) {
				$aleatoria .= chr(rand(97, 122));
			}

			$palabras[] = $patron[0] . $aleatoria . $patron[$longitud - 1];
		}



		$array['numeros'] = $numeros;
		$array['palabras'] = $palabras;

		header("Content-Type: application/json; charset=utf-8");

		echo json_encode([$array]);
		exit;
	}

	public function accionPeticionAjax()
	{

		$this->barraUbi = $this->menu;
		$this->actual = $this->menu["practicas2"]['hijos']['peticionAjax'];

		$this->dibujaVista(
			"ajax",
			[],
			"Peticion Ajax"
		);
	}
}
