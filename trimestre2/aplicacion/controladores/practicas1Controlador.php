<?php

final class practicas1Controlador extends CControlador
{
    public array $menu = [];
    public array $menuizq = [];
    public array $barraUbi = [];
    public array $actual = [];

    public function __construct()
    {
        $this->menu = require __DIR__ . "/../config/menu.php";
        $this->menuizq = $this->menu['practicas1']['hijos'];

        session_start();
    }

    public function accionMiindice()
    {

        $this->barraUbi = $this->menu;
        $this->actual = $this->menu["practicas1"];

        $this->dibujaVista(
            "miindice",
            [],
            "Prácticas 1"
        );
    }

    public function accionEjercicio1()
    {
        $this->barraUbi = $this->menu;
        $this->actual = $this->menu["practicas1"]['hijos']['ejercicio1'];

        $this->dibujaVista("ejercicio1", [], "Relacion 1 - Ejercicio 1");
    }
    public function accionEjercicio2()
    {

        $this->barraUbi = $this->menu;
        $this->actual = $this->menu["practicas1"]['hijos']['ejercicio2'];

        $this->dibujaVista("ejercicio2", [], "Relacion 1 - Ejercicio 2");
    }
    public function accionEjercicio3()
    {

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

        $this->barraUbi = $this->menu;
        $this->actual = $this->menu["practicas1"]['hijos']['ejercicio3'];

        $this->dibujaVista("ejercicio3", ['datos' => $datos], "Relacion 1 - Ejercicio 3");
    }
    public function accionEjercicio7()
    {

        $this->barraUbi = $this->menu;
        $this->actual = $this->menu["practicas1"]['hijos']['ejercicio7'];

        $this->dibujaVista("ejercicio7", [], "Relacion 1 - Ejercicio 7");
    }

    public function accionEjer5()
    {

        $this->barraUbi = $this->menu;
        $this->actual = $this->menu["practicas1"]['hijos']['ejer5'];

        $vector = array();
        $vector[1] = "esto es una cadena";
        $vector["posi1"] = 25.67;
        $vector[] = false;
        $vector["ultima"] = array(2, 5, 96);
        $vector[56] = 23;

        $this->dibujaVista("vistaejer5", ["vector" => $vector], "Relacion 1 - Ejercicio 5");
    }
}
