<?php
include_once(dirname(__FILE__) . "/cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ]
];

$contador = 0;

if (isset($_COOKIE['visitas'])) {
    $contador = $_COOKIE['visitas'] + 1;
} else {
    $contador = 1;
}

setcookie('visitas', $contador, time() + (10 * 365 * 24 * 3600), '/');

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($contador);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($contador)
{
?>
    <p>Estas en el inicio. Has visitado la página un total de <?= $contador ?> veces.</p>
<?php
}
