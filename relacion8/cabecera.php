<?php
define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO", "desarrollo"); //en "produccion o en desarrollo

include_once(dirname(__FILE__) . "/scripts/bookstores/validacion.php");

spl_autoload_register(function ($clase) {
    $ruta = RUTABASE . "/scripts/class/";
    $fichero = $ruta . "$clase.php";

    if (file_exists($fichero)) {
        
        require_once($fichero);
    } else {
        throw new Exception("La clase $clase no se ha encontrado.");
    }
});

const COLORESFONDO = [
    'blanco' => 'white', 
    'verde' => 'green', 
    'rojo' => 'red', 
    'azul' => 'blue',
    'cyan' => 'cyan'
];

const COLORESTEXTO = [
    'negro' => 'black',
    'blanco' => 'white',  
    'rojo' => 'red', 
    'azul' => 'blue'
];

session_start();

$acceso = new Acceso();

$validado = $_SESSION['acceso']['validado'];

if (MODO_TRABAJO == "produccion")
    error_reporting(0);
else
    error_reporting(E_ALL);

include(RUTABASE . "/aplicacion/templates/plantilla.php");
include(RUTABASE . "/aplicacion/config/acceso_bd.php");

 //creo todos los objetos que necesita mi aplicacion.