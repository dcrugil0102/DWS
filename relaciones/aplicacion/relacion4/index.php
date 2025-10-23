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
// $guitarra1 = new InstrumentoBase("Esto es una guitarra", 3);
// $guitarra2 = new InstrumentoBase("Esto es una guitarra", 3);
// $guitarra3 = new InstrumentoBase("Esto es una guitarra", 3);
// $guitarra4 = new InstrumentoBase("Esto es una guitarra", 3);
// $guitarra5 = new InstrumentoBase("Esto es una guitarra", 3);

// EJERCICIO 3
$instrViento = new InstrumentoViento("metal", 5);

// EJERCICIO 4

$flauta = Flauta::crearDesdeArray(['material' => 'plastico', 'edad' => 1]);

// EJERCICIO 5

$estados = EstadoCivil::casos();

$persona = Persona::registrarPersona("Damián", "01/02/2006", "calle alhambra de granada", "antequera", $estados[rand(0, count($estados) - 1)]);

$datos = ['instrViento' => $instrViento, 'flauta' => $flauta, 'persona' => $persona];

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

    echo "<p>// Esta comentado porque la clase es abstracta</p>"

    ?>
    <h3>EJERCICIO 3:</h3>

    <?php

    $instrViento = $datos['instrViento'];
    echo "<p><strong>Descripción:</strong> " . $instrViento . ", " . $instrViento->getDescripcion() . ".</p>";

    echo "<p><strong>Edad:</strong> " . $instrViento->getEdad() . " años</p>";
    $instrViento->envejecer();
    echo "<p><strong>Edad:</strong> " . $instrViento->getEdad() . " años</p>";

    echo "<pre>" . $instrViento->afinar() . "</pre>";

    echo "<p>" . $instrViento->sonido() . "</p>";

    ?>
    <h3>EJERCICIO 4:</h3>
    <?php

    $flauta = $datos['flauta'];
    echo "<p>" . $flauta . "</p>";
    $flauta2 = $flauta->clonacion();
    echo "<p>" . $flauta2 . "</p>";

    echo "<p><strong>Método recilado: </strong>" . $flauta2->metodoReciclado() . "</p>";

    ?>
    <h3>EJERCICIO 5:</h3>
<?php

    $persona = $datos['persona'];

    echo "<p><strong>Persona: </strong>" . $persona . "</p>";
}
