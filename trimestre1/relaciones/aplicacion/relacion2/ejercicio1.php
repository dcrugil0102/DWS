<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion2",
        "LINK" => "/aplicacion/relacion2"
    ],
    [
        "TEXTO" => "Ejercicio1",
        "LINK" => "/aplicacion/relacion2/ejercicio1.php"
    ]
];

// *********CONTROLADOR************

$nombre = "Damián";
$edad = 19;

$cadena1 = "Hola, me llamo $nombre y tengo $edad años.";

$cadena2 = 'Hola, me llamo $nombre y tengo $edad años.';

$cadena3 = <<<HTML
<h3>Bienvenido, $nombre</h1>
<p>Tienes $edad años</p>
<p>Caracteres especiales: á, é, ñ, ", '</p>
HTML;

$cadena4 = <<<'HTML'
<h3>Bienvenido, $nombre</h1>
<p>Tienes $edad años</p>
<p>Caracteres especiales: á, é, ñ, ", '</p>
HTML;

$datos = [$cadena1, $cadena2, $cadena3, $cadena4];

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($datos);
finCuerpo();

// *****************VISTA***********************

function cabecera() {}


function cuerpo($datos)
{
?>
    <h1>EJERCICIO 1:</h1>
<?php

    echo $datos[0];
    echo "<br>";
    echo $datos[1] . PHP_EOL;
    echo $datos[2];
    echo $datos[3];
}
