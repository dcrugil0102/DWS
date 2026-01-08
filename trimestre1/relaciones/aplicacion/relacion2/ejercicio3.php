<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion2",
        "LINK" => "/aplicacion/relacion2"
    ],
    [
        "TEXTO" => "Ejercicio3",
        "LINK" => "/aplicacion/relacion2/ejercicio3.php"
    ]
];

// *****************CONTROLADOR**************************

$caracteres = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

$cadena1 = "";
$cadena2 = "";

for ($i = 0; $i < 20; $i++) {
    $cadena1 .= $caracteres[mt_rand(0, count($caracteres) - 1)];
    $cadena2 .= chr(mt_rand(32, 126));
}

$datos = ['cadena1' => $cadena1, 'cadena2' => $cadena2];

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($datos);
finCuerpo();

// **********************************************************

function cabecera() {}


function cuerpo($datos)
{
?>
    <h1>Ejercicio 3:</h1>
    <h3>a partir de un array con los caracteres correctos</h3>
    <?php

    echo $datos['cadena1'];

    ?>

    <h3>a partir del codigo ASCII quitando no válidos</h3>

<?php

    echo $datos['cadena2'];
}
