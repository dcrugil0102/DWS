<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion1",
        "LINK" => "/aplicacion/relacion1"
    ],
    [
        "TEXTO" => "Ejercicio5",
        "LINK" => "/aplicacion/relacion1/ejercicio5.php"
    ]
];

$vector = array();
$vector[1] = "esto es una cadena";
$vector["posi1"] = 25.67;
$vector[] = false;
$vector["ultima"] = array(2, 5, 96);
$vector[56] = 23;

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($vector);
finCuerpo();

function cabecera() {}

function cuerpo($vector)
{
?>

    <h1>Ejercicio 5:</h1>

<?php
    foreach ($vector as $posicion => $contenido) {
        echo "- posicion $posicion contenido (tipo) ";

        if (is_array($contenido)) {
            echo "array:<br>";
            foreach ($contenido as $valor) {
                echo "--- $valor<br>";
            }
        } elseif (is_int($contenido)) {
            $binario = decbin($contenido);
            echo "entero bonito valor $contenido en binario $binario<br>";
        } elseif (is_float($contenido)) {
            $cuadrado = $contenido * $contenido;
            echo "$contenido que al cuadrado es $cuadrado<br>";
        } elseif (is_string($contenido)) {
            echo "-$contenido-<br>";
        } elseif (is_bool($contenido)) {
            $texto = $contenido ? "true" : "false";
            $opuesto = !$contenido ? "true" : "false";
            echo "$texto y su opuesto $opuesto<br>";
        }
    }
}
?>
```