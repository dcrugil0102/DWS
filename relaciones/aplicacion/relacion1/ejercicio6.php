<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$vector = array(
    "primera" => 12.56,
    24 => true,
    67 => 23.76
);

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo($vector);
finCuerpo();

function cabecera() {}

function cuerpo($vector)
{

?>
    <h1>Ejercicio 6:</h1>

    <h2>Simulación con funciones de recorrido</h2>
    <?php
    reset($vector);
    while (key($vector) !== null) {
        $indice = key($vector);
        $valor = current($vector);
        echo "Índice: $indice => Valor: $valor<br>";
        next($vector);
    }
    ?>

    <h2>Simulación con array_keys y array_values</h2>

<?php
    $indices = array_keys($vector);
    $valores = array_values($vector);

    for ($i = 0; $i < count($indices); $i++) {
        echo "Índice: {$indices[$i]} => Valor: {$valores[$i]}<br>";
    }
}
?>