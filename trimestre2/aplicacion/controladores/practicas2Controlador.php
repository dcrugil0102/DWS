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

	public function accionMierror(){
		$this->menuizq[] =
            [
				"texto" => "ERROR", 
				"enlace" => ["practicas2/mierror"]
			];

		$this->barraUbi[] =
			[
				"texto" => "ERROR", 
				"enlace" => ["practicas2/mierror"]
			];

		$this->dibujaVista("mierror",[],
							"ERROR");
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

		
	}
}
