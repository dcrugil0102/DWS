<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// CONTROLADOR **********************************************

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

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo($datos);
finCuerpo();

// VISTA *****************************************************

function cabecera() {}


function cuerpo($datos)
{
?>

    <h1>Ejercicio 3:</h1>

<?php

    echo "<h3>Array 1:</h3>";

    foreach ($datos[0] as $indice => $valor) {
        if (is_array($valor)) {
            foreach ($valor as $indice2 => $valor2) {
                echo "<p>array1[$indice][$indice2] = $valor2</p>";
            }
        } else
            echo "<p>array1[$indice] = $valor</p>";
    }

    echo "<h3>Array 2:</h3>";

    foreach ($datos[1] as $indice => $valor) {
        if (is_array($valor)) {
            foreach ($valor as $indice2 => $valor2) {
                echo "<p>array2[$indice][$indice2] = $valor2</p>";
            }
        } else
            echo "<p>array2[$indice] = $valor</p>";
    }

    echo "<h3>Array 3:</h3>";

    foreach ($datos[2] as $indice => $valor) {
        if (is_array($valor)) {
            foreach ($valor as $indice2 => $valor2) {
                echo "<p>array3[$indice][$indice2] = $valor2</p>";
            }
        } else
            echo "<p>array3[$indice] = $valor</p>";
    }
}
