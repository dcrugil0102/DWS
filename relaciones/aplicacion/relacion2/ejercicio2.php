<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// *********CONTROLADOR************

$cadena = "Está la niña en casa";
$datos = ['cadena' => $cadena];

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo($datos);
finCuerpo();

// *****************VISTA***********************

function cabecera() {}


function cuerpo($datos)
{
?>
    <h1>EJERCICIO 2:</h1>
<?php
    $cadena = $datos['cadena'];
    for ($i = 0; $i < mb_strlen($cadena); $i++) {
        echo "<p>";
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        echo $cadena[$i] . "</p>";
    }
}
