<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Pruebas",
        "LINK" => "/aplicacion/tests"
    ]
];

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
    <ul>
        <li><a href="./sintaxisBasica.php">Sintaxis basica</a></li>
    </ul>
<?php
}
