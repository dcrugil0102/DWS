<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$var = 12;

if (isset($var)) {
    $var++;

    unset($var);

    $var = mt_rand(1, 10);
    $nombre = "profesor";
    $apellido = "2daw";
    $var = "nombre";

    if ($num <= 5)
        $var = "nombre";
    else
        $var = "apellido";
    $resultado = $$var;

    $var = 12;

    if (gettype($var) == "integer") {
        $resultado = "es entero";
    }

    $var = "esto es una cadena";
    if (gettype($var) == "string") {
        $resultado = "es una cadena";
    }
}


inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo()
{
?>
    estas en pruebas basicas
<?php
}
