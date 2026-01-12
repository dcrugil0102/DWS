<?php
	 
class inicialControlador extends CControlador
{
	public array $menuizq=[];
	public array $barraUbi=[];
	public array $ejercicios=[];
	public function accionIndex()
	{
		

		$this->menuizq = [
			[
				"texto" => "Inicio", 
				"enlace" => ["inicial"]
			]
		];

		$this->barraUbi = [
			[
				"texto" => "Inicio", 
				"enlace" => ["inicial"]
			]
		];

		$this->ejercicios = [
            "practicas1" => [
				"titulo" => "Prácticas 1",
				"vista" => "miindice",
				"ejercicios" => [
					"ejercicio1" => "Ejercicio 1",
					"ejercicio2" => "Ejercicio 2",
					"ejercicio3" => "Ejercicio 3",
					"ejercicio7" => "Ejercicio 7"
				]
			],
			"practicas2" => [
				"titulo" => "Prácticas 2",
				"vista" => "index"
			]
        ];

		$this->dibujaVista("index",[],
							"Pagina principal");

							
	}

	
}
