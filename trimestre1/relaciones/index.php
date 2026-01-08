<?php
include_once(dirname(__FILE__) . "/cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ]
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
    <p>Estas en el inicio.</p>
<?php
}
