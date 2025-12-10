<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Modificar coleccion",
        "LINK" => "/aplicacion/colecciones/modificar.php"
    ]
];

$valores = [
    'nombre' => '',
    'fecha' => '',
    'tematica' => 10
];

$errores = [];
$coleccion = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['index'])) {
        $coleccion = $COLECCIONES[$_POST['colecciones']];

        if (!isset($coleccion)) {
            paginaError("Coleccion no encontrada");
            exit();
        }

        
    }

}



