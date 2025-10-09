<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// *****************CONTROLADOR**************************

$valor1 = 17.5;
$valor2 = 379987.24;



$datos = ['valor1' => $valor1, 'valor2' => $valor2];

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo($datos);
finCuerpo();

// **********************************************************

function cabecera() {}


function cuerpo($datos)
{
?>
    <h1>Ejercicio 4:</h1>

<?php
    echo str_pad(number_format($datos['valor1'], 1, ","), 15, 0, STR_PAD_LEFT);
    echo "<br/>";
    echo number_format($datos['valor2'], 2, ",", ".");
}
