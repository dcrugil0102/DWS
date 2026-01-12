<?php

final class practicas2Controlador extends CControlador
{
    public array $menuizq=[];
    public array $barraUbi=[];
	public function accionIndex()
	{
		

		$this->menuizq = [
			[
				"texto" => "Inicio", 
				"enlace" => ["inicial"]
            ],
            [
				"texto" => "Practicas 2", 
				"enlace" => ["practicas2/index"]
			]
		];

		$this->barraUbi = [
			[
				"texto" => "Inicio", 
				"enlace" => ["inicial"]
            ],
            [
				"texto" => "Practicas 2", 
				"enlace" => ["practicas2/index"]
			]
		];

		$this->dibujaVista("index",[],
							"Prácticas 2");

							
	}
}
