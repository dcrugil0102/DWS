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
            "relacion1" => [
				"titulo" => "Relacion 1",
				"ejercicio1" => "Ejercicio 1",
				"ejercicio2" => "Ejercicio 2",
				"ejercicio3" => "Ejercicio 3",
				"ejercicio7" => "Ejercicio 7"
			],
			"relacion2" => [
				"titulo" => "Relacion 2",
				
			]
        ];

		$this->dibujaVista("index",[],
							"Pagina principal");

							
	}

	
}
