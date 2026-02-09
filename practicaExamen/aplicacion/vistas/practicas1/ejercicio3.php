<?php
echo "Ejercicio 3";
echo "<br>";
function mostrararray($array)
{
    foreach ($array as $key => $valor) {
        echo "la clave es " . $key . " y el valor es " . (is_array($valor) ? implode(', ', $valor) : $valor) . "<br>";
    }
}
echo "<br>";
echo "<br>";
echo "Array 1 <br>";
mostrararray($arra);
echo "Array 2 <br>";
mostrararray($arra2);
echo "Array 3 <br>";
mostrararray($arra3);
echo "<br>";
echo CHTML::link("volver", Sistema::app()->generaURL(["practicas1", "miindice"]));
