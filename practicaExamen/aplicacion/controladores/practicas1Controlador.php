<?php

class practicas1Controlador extends CControlador
{
	public array $menuizq = [];
	public array $menuhead = [];
	public function __construct() {}

	public function accionMiindice()
	{
		$this->menuizq = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practicas 1",
				"enlace" => ["practicas1/miindice"]
			],
			[
				"texto" => "Ejercicio 1",
				"enlace" => ["practicas1/ejercicio1"]
			],
			[
				"texto" => "Ejercicio 2",
				"enlace" => ["practicas1/ejercicio2"]
			],
			[
				"texto" => "Ejercicio 3",
				"enlace" => ["practicas1/ejercicio3"]
			],
			[
				"texto" => "Ejercicio 7",
				"enlace" => ["practicas1/ejercicio7"]
			],
			[
				"texto" => "Ejercicio 5",
				"enlace" => ["practicas1/ejercicio5"]
			]
		];
		$this->menuhead = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practicas 1",
				"enlace" => ["practicas1/miindice"]
			]
		];
		$this->dibujaVista(
			"miindice",
			[],
			"Mi indice"
		);
	}
	public function accionEjercicio1()
	{
		$this->menuhead = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practicas 1",
				"enlace" => ["practicas1/miindice"]
			],
			[
				"texto" => "Ejercicio 1",
				"enlace" => ["practicas1/ejercicio1"]
			]
		];
		$this->dibujaVista(
			"ejercicio1",
			[],
			"Ejercicio 1"
		);
	}
	public function accionEjercicio2()
	{
		$this->menuhead = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practicas 1",
				"enlace" => ["practicas1/miindice"]
			],
			[
				"texto" => "Ejercicio 2",
				"enlace" => ["practicas1/ejercicio2"]
			]
		];
		$this->dibujaVista(
			"ejercicio2",
			[],
			"Ejercicio 2"
		);
	}
	public function accionEjercicio3()
	{
		$this->menuhead = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practicas 1",
				"enlace" => ["practicas1/miindice"]
			],
			[
				"texto" => "Ejercicio 3",
				"enlace" => ["practicas1/ejercicio3"]
			]
		];

		$array1 = [
			"1" => "uno",
			"16" => "dieciseis",
			"54" => "cincuenta y cuatro",
			"" => "34",
			"uno" => "cadena",
			"dos" => true,
			"tres" => 1.345,
			"ultima" => [1, 34, "nueva"]
		];
		$array2 = [
			"1" => "uno",
			"16" => "dieciseis",
			"54" => "cincuenta y cuatro",
			"" => 34,
			"uno" => "cadena",
			"dos" => true,
			"tres" => 1.345,
			"ultima" => [1, 34, "nueva"],
		];
		$array3 = array(
			"1" => "uno",
			"16" => "dieciseis",
			"54" => "cincuenta y cuatro",
			"" => 34,
			"uno" => "cadena",
			"dos" => true,
			"tres" => 1.345,
			"ultima" => [1, 34, "nueva"],
		);
		$this->dibujaVista(
			"ejercicio3",
			["arra" => $array1, "arra2" => $array2, "arra3" => $array3],
			"Ejercicio 3"
		);
	}
	public function accionEjercicio7()
	{
		$this->menuhead = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practicas 1",
				"enlace" => ["practicas1/miindice"]
			],
			[
				"texto" => "Ejercicio 7",
				"enlace" => ["practicas1/ejercicio7"]
			]
		];
		$this->dibujaVista(
			"ejercicio7",
			[],
			"Ejercicio 7"
		);
	}
	public function accionEjercicio5()
	{
		$this->menuhead = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			],
			[
				"texto" => "Practicas 1",
				"enlace" => ["practicas1/miindice"]
			],
			[
				"texto" => "Ejercicio 5",
				"enlace" => ["practicas1/ejercicio5"]
			]
		];
		$valores = [
			"1" => "esto es una cadena",
			"posil" => 25.67,
			"" => false,
			"ultima" => array(2, 5, 96),
			"56" => 23
		];
		$this->dibujaVista(
			"vistaejercicio5",
			array("valore" => $valores),
			"Ejercicio 5"
		);
	}
}
