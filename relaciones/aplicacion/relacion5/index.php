<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/librerias/val_normal.php");
include_once(dirname(__FILE__) . "/librerias/val_filter.php");


$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK"  => "/index.php",
    ],
    [
        "TEXTO" => "Relacion 5",
        "LINK"  => "/aplicacion/relacion5",
    ],
];

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo();
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo()
{
?>
    <h2>Ejercicio 1:</h2>

    <h3>Sin filter</h3>
<?php
        $var = 3;   
        $min = 1;
        $max = 5;
        $def = 2;
        echo VALFILTER_validaReal($var, $min, $max, $def);
        echo "<br/>".$var;
}
