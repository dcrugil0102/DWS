<?php

final class practicas1Controlador extends CControlador
{
    public array $menuizq=[];
    public array $barraUbi=[];
    public array $ejercicios = [];
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
			]
		];

		$this->barraUbi = [
			[
				"texto" => "Inicio", 
				"enlace" => ["inicial"]
            ],
            [
				"texto" => "Practicas 1", 
				"enlace" => ["practicas1/miindice"]
			]
		];

		$this->dibujaVista("miindice",[],
							"Prácticas 1");
		
	}

    public function accionEjercicio1(){
        $this->dibujaVista("ejercicio1", [], "Relacion 1 - Ejercicio 1");
        $this->ejercicios[] = "ejercicio1";
    }
}
