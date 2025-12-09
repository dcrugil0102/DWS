<?php
define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO", "desarrollo"); //en "produccion o en desarrollo

include_once(dirname(__FILE__) . "/scripts/bookstores/validacion.php");


spl_autoload_register(function ($clase) {
    $ruta = RUTABASE . "/scripts/class/";
    $ruta2 = RUTABASE . "/scripts/diciembre/";
    $fichero = $ruta . "$clase.php";
    $fichero2 = $ruta2 . "$clase.php";

    if (file_exists($fichero)) {

        require_once($fichero);
    } else if(file_exists($fichero2)){

        require_once($fichero2);
    } else{
        throw new Exception("La clase $clase no se ha encontrado.");
    }
});

session_start();

$coleccion1 = new Coleccion("Harry Potter");
$coleccion1->aniadirLibro(new Libro("Harry Potter 1", "Pablo Moron", "paginas", 300, "color", "rojo"));
$coleccion1->aniadirLibro(new Libro("Harry Potter 2", "Pablo Moron", "paginas", 400, "color", "verde"));
$coleccion1->aniadirLibro(new Libro("Harry Potter 3", "Pablo Moron", "paginas", 350, "color", "amarillo"));

$coleccion2 = new Coleccion("Juego de Tronos");
$coleccion1->aniadirLibro(new Libro("Juego de Tronos T1", "Alvaro Cobos", "paginas", 250, "temporada", "1"));
$coleccion1->aniadirLibro(new Libro("Juego de Tronos T2", "Alvaro Cobos", "paginas", 399, "temporada", "2"));
$coleccion1->aniadirLibro(new Libro("Juego de Tronos T3", "Alvaro Cobos", "paginas", 311, "temporada", "3"));

$COLECCIONES = [];
$COLECCIONES[] = $coleccion1;
$COLECCIONES[] = $coleccion2;

$acceso = new Acceso();

if (MODO_TRABAJO == "produccion")
    error_reporting(0);
else
    error_reporting(E_ALL);

include(RUTABASE . "/aplicacion/templates/plantilla.php");
include(RUTABASE . "/aplicacion/config/acceso_bd.php");

 //creo todos los objetos que necesita mi aplicacion.