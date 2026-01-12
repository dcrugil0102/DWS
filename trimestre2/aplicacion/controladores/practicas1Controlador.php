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
        $this->menuizq[] = ["texto" => "Ejercicio 1", "enlace" => ["practicas1/ejercicio1"]];
        $this->barraUbi[] = ["texto" => "Ejercicio 1", "enlace" => ["practicas1/ejercicio1"]];
        $this->dibujaVista("ejercicio1", [], "Relacion 1 - Ejercicio 1");
        
    }
    public function accionEjercicio2(){

        $this->inicializarMenus();
        $this->menuizq[] = ["texto" => "Ejercicio 2", "enlace" => ["practicas1/ejercicio2"]];
        $this->barraUbi[] = ["texto" => "Ejercicio 2", "enlace" => ["practicas1/ejercicio2"]];
        $this->dibujaVista("ejercicio2", [], "Relacion 1 - Ejercicio 2");
        
    }
    public function accionEjercicio3(){

        $this->inicializarMenus();

        $array1 = array();
        $array1[1] = "valor cualquiera";
        $array1[16] = "valor cualquiera";
        $array1[54] = "valor cualquiera";
        $array1[] = 34;
        $array1["uno"] = "cadena";
        $array1["dos"] = true;
        $array1["tres"] = 1.345;
        $array1["ultima"] = array(1, 34, "nueva");

        $array2 = array(
            1 => "valor cualquiera",
            16 => "valor cualquiera",
            54 => "valor cualquiera",
            55 => 34,
            "uno" => "cadena",
            "dos" => true,
            "tres" => 1.345,
            "ultima" => array(1, 34, "nueva")
        );

        $array3 = [
            1 => "valor cualquiera",
            16 => "valor cualquiera",
            54 => "valor cualquiera",
            55 => 34,
            "uno" => "cadena",
            "dos" => true,
            "tres" => 1.345,
            "ultima" => array(1, 34, "nueva")
        ];

        $datos = [$array1, $array2, $array3];

        $this->menuizq[] = ["texto" => "Ejercicio 3", "enlace" => ["practicas1/ejercicio3"]];
        $this->barraUbi[] = ["texto" => "Ejercicio 3", "enlace" => ["practicas1/ejercicio3"]];
        $this->dibujaVista("ejercicio3", ['datos' => $datos], "Relacion 1 - Ejercicio 3");
        
    }
    public function accionEjercicio7(){

        $this->inicializarMenus();
        $this->menuizq[] = ["texto" => "Ejercicio 7", "enlace" => ["practicas1/ejercicio7"]];
        $this->barraUbi[] = ["texto" => "Ejercicio 7", "enlace" => ["practicas1/ejercicio7"]];
        $this->dibujaVista("ejercicio7", [], "Relacion 1 - Ejercicio 7");
        
    }
}
