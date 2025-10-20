<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 4",
        "LINK" => "/aplicacion/relacion4"
    ]
];

// *************** CONTROLADOR *********************

// EJERCICIO 1
$guitarra1 = new InstrumentoBase("Esto es una guitarra", 3);
$guitarra2 = new InstrumentoBase("Esto es una guitarra", 3);
$guitarra3 = new InstrumentoBase("Esto es una guitarra", 3);
$guitarra4 = new InstrumentoBase("Esto es una guitarra", 3);
$guitarra5 = new InstrumentoBase("Esto es una guitarra", 3);


$datos = ['guitarra1' => $guitarra1, 'guitarra4' => $guitarra4];

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
    <h3>EJERCICIO 1:</h3>
    <?php

    // $guitarra1 = $datos['guitarra1'];
    // $guitarra4 = $datos['guitarra4'];

    // echo $guitarra1->__toString();
    // $guitarra1->envejecer();
    // echo "<br/>" . $guitarra1->__toString() . "<br/>";
    // echo $guitarra4->__toString();

    ?>
    <h3>EJERCICIO 2:</h3>
<?php

}
