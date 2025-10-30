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
        $var = "32/2/2006";
        $def = "01/01/2000";
        $array = [1 => 'jose', 2 => 'carlos', 3 => 'maria', 4=>'gonzalo'];
        $tipo = 2;
        
        if (VALFILTER_validaFecha($var, $def)) 
            echo "<p style='color:green;font-weight:bold;'>true : $var</p>";
        else
            echo "<p style='color:red;font-weight:bold;'>false : $var</p>";
        
}
