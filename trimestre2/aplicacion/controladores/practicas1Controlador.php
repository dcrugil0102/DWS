<?php

final class practicas1Controlador extends CControlador
{
    public array $menuizq=[];
    public array $barraUbi=[];
	public function accionMiindice()
	{
		

		$this->menuizq = [
			[
				"texto" => "Inicio", 
				"enlace" => ["inicial"]
            ],
            [
				"texto" => "Practicas 1", 
				"enlace" => ["practicas1"]
			]
		];

		$this->barraUbi = [
			[
				"texto" => "Inicio", 
				"enlace" => ["inicial"]
            ],
            [
				"texto" => "Practicas 1", 
				"enlace" => ["practicas1"]
			]
		];

		$this->dibujaVista("miindice",[],
							"Prácticas 2");

							
	}
}
