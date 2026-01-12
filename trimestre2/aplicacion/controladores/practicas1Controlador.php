<?php

final class practicas1Controlador extends CControlador
{
    public array $menuizq=[];
    public array $barraUbi=[];
    public array $ejercicios = [];

    private function inicializarMenus()
    {
        $this->menuizq = [
            ["texto" => "Inicio", "enlace" => ["inicial"]],
            ["texto" => "Practicas 1", "enlace" => ["practicas1/miindice"]]
        ];

        $this->barraUbi = [
            ["texto" => "Inicio", "enlace" => ["inicial"]],
            ["texto" => "Practicas 1", "enlace" => ["practicas1/miindice"]]
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
    }

	public function accionMiindice()
	{
        $this->inicializarMenus();

		$this->dibujaVista("miindice",[],
							"Prácticas 1");	
	}

    public function accionEjercicio1(){

        $this->inicializarMenus();
        $this->dibujaVista("ejercicio1", [], "Relacion 1 - Ejercicio 1");
        
    }
}
