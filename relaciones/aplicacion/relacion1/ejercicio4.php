<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

define("FILAS", 5);

$numeros = [];
for ($i = 1; $i <= FILAS; $i++) {
    $fila = [];
    for ($j = 1; $j <= $i; $j++) {
        $fila[] = $i;
    }
    $numeros[] = $fila;
}

function cabecera() {}

function cuerpo($numeros)
{
?>
    <h1>Ejercicio 4:</h1>
<?php
    foreach ($numeros as $fila) {
        foreach ($fila as $valor) {
            echo $valor . " ";
        }
        echo "<br>";
    }
}

// ********** VISTA **********

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo($numeros);
finCuerpo();
?>