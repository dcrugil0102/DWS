<?php
define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO", "desarrollo"); //en "produccion o en desarrollo

include_once(dirname(__FILE__) . "/scripts/bookstores/validacion.php");

$arrayPuntos = [];

if (file_exists(__DIR__ . $nombrePunto)) {
    $fic = fopen(__DIR__ . $nombrePunto, "r");
    while($linea = fgets($fic) !== false){
        $datos = explode(';', trim($linea));
            $arrayPuntos[] = new Punto($datos[0],$datos[1], $datos[2], $datos[3]);
    }
}

print_r($arrayPuntos);



if (MODO_TRABAJO == "produccion")
    error_reporting(0);
else
    error_reporting(E_ALL);


spl_autoload_register(function ($clase) {
    $ruta = RUTABASE . "/scripts/class/";
    $fichero = $ruta . "$clase.php";

    if (file_exists($fichero)) {
        require_once($fichero);
    } else {
        throw new Exception("La clase $clase no se ha encontrado.");
    }
});

include(RUTABASE . "/aplicacion/templates/plantilla.php");
include(RUTABASE . "/aplicacion/config/acceso_bd.php");

 //creo todos los objetos que necesita mi aplicacion.