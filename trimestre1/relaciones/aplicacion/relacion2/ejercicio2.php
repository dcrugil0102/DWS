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
        "TEXTO" => "Ejercicio2",
        "LINK" => "/aplicacion/relacion2/ejercicio2.php"
    ]
];

// *********CONTROLADOR************

$cadena = "Está la niña en casa";
$datos = ['cadena' => $cadena];

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($datos);
finCuerpo();

// *****************VISTA***********************

function cabecera() {}


function cuerpo($datos)
{
?>
    <h1>EJERCICIO 2:</h1>
    <h3>Con corchetes</h3>
    <?php
    $cadena = $datos['cadena'];
    for ($i = 0; $i < strlen($cadena); $i++) {
        echo "<p>";
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        echo $cadena[$i] . "</p>";
    }

    ?>

    <h3>Con substr</h3>

    <?php

    for ($i = 0; $i < strlen($cadena); $i++) {
        echo "<p>";
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        echo substr($cadena, $i, 1) . "</p>";
    }

    ?>

    <h3>Con mb_substr</h3>

    <?php

    for ($i = 0; $i < mb_strlen($cadena); $i++) {
        echo "<p>";
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        echo mb_substr($cadena, $i, 1) . "</p>";
    }

    ?>

    <h3>Cadena revertida</h3>

    <?php

    for ($i = mb_strlen($cadena); $i >= 0; $i--) {
        echo "<p>";
        for ($j = mb_strlen($cadena) - 1; $j > $i; $j--) {
            echo "&nbsp;";
        }
        echo (($i % 2 == 0) ? mb_strtoupper(mb_substr($cadena, $i, 1)) : mb_substr($cadena, $i, 1)) . "</p>";
    }

    ?>

    <h3>Cadena separada por partes</h3>

    <?php

    $cadenaSeparada = explode("a", $cadena);
    foreach ($cadenaSeparada as $key => $value) {
        echo "<p>$value</p>";
    }

    ?>

    <h3>Remplazar caracter</h3>

<?php

    $posNina = mb_strpos($cadena, "niña");

    echo str_replace(strlen($posNina), "niña/mujer ", $cadena,);
}
