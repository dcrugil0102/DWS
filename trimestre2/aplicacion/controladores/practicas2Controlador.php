<?php

final class practicas2Controlador extends CControlador
{
    public array $menuizq=[
		["texto" => "Inicio", 
		"enlace" => "inicial"]
	];
    public array $barraUbi=[
		["texto" => "Inicio", 
		"enlace" => "inicial"]
	];
    public array $ejercicios=[
		"practicas1" => [
                "titulo" => "Prácticas 1",
                "vista" => "miindice",
                "ejercicios" => [
                    "ejercicio1" => "Ejercicio 1",
                    "ejercicio2" => "Ejercicio 2",
                    "ejercicio3" => "Ejercicio 3",
                    "ejer5" => "Ejercicio 5",
                    "ejercicio7" => "Ejercicio 7"
                ]
            ],
            "practicas2" => [
                "titulo" => "Prácticas 2",
                "vista" => "index"
            ]
	];

	public function accionIndex()
	{
	
		$this->menuizq[] =
            [
				"texto" => "Practicas 2", 
				"enlace" => ["practicas2/index"]
			];

		$this->barraUbi[] =
			[
				"texto" => "Practicas 2", 
				"enlace" => ["practicas2/index"]
			];

		$this->dibujaVista("index",["barraUbi" => $this->barraUbi],
							"Prácticas 2");

							
	}

	public function accionMierror()
	{
		Sistema::app()->paginaError(404, "No seas malo y no accedas a esta página");
	}

	public function accionDescarga1(){
		$this->menuizq[] =
            [
				"texto" => "Descarga 1", 
				"enlace" => ["practicas2/descarga1"]
			];

		$this->barraUbi[] =
			[
				"texto" => "Descarga 1", 
				"enlace" => ["practicas2/descarga1"]
			];

		$this->dibujaVista("descarga1",[],
							"Descarga 1");
	}

	public function accionDescarga2(){

		$archivo = __DIR__ . "/../../imagenes/chicotetactico.jpg";

		if (file_exists($archivo)) {
			header('Content-Type: image/jpeg');
			header('Content-Disposition: attachment; filename="'.basename($archivo).'"');

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

	public function accionPeticionAjax(){
		$this->menuizq[] =
            [
				"texto" => "Peticion Ajax", 
				"enlace" => ["practicas2/ajax"]
			];

		$this->barraUbi[] =
			[
				"texto" => "Peticion Ajax", 
				"enlace" => ["practicas2/ajax"]
			];

		$this->dibujaVista("ajax",[],
							"Peticion Ajax");
	}
}
