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
        "TEXTO" => "Ejercicio4",
        "LINK" => "/aplicacion/relacion1/ejercicio4.php"
    ]
];

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

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($numeros);
finCuerpo();
?>