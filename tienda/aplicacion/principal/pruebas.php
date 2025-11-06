<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/class/curso2025/MuebleBase.php");
include_once(dirname(__FILE__) . "/../../scripts/class/curso2025/MuebleTradicional.php");
include_once(dirname(__FILE__) . "/../../scripts/class/curso2025/MuebleReciclado.php");
include_once(dirname(__FILE__) . "/../../scripts/class/curso2025/Caracteristicas.php");


$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/aplicacion/principal/pruebas.php"
    ]
];

// ----- CONTROLADOR -----

$muebles = [];
$errores = [];

try {

    $m1 = new MuebleTradicional(
        "Mesa de Roble",
        1,
        120.50,
        25.5,
        "S12",
        "FMu: Roble",
        "España",
        2022,
        "01/02/2022",
        "01/02/2030"
    );

    $m1->añadir("color", "marrón", "pesoExtra", 10);
    $muebles[] = $m1;


    $m2 = new MuebleReciclado(
        "Silla Eco",
        60,
        2,
        "FMu: Verde",
        "España",
        2023,
        "01/03/2023",
        "01/03/2035",
        80.75
    );

    $m2->añadir("color", "verde", "peso", 12);
    $muebles[] = $m2;

    // Probar “ningunamas”
    $carac = new Caracteristicas();
    $carac->__set("ningunamas", true);
    try {
        $carac->__set("nuevo", 123);
    } catch (Exception $e) {
        $errores[] = $e->getMessage();
    }
} catch (Exception $e) {
    $errores[] = $e->getMessage();
}

$datos = ['muebles' => $muebles, "errores" => $errores];

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
    $muebles = $datos['muebles'];
    $errores = $datos['errores'];
?>
    <h2>Pruebas de Muebles</h2>

<?php
    if (!empty($errores)) {
        echo '<div style="color:red">';
        echo '<h3>Errores:</h3><ul>';
        foreach ($errores as $e) {
            echo "<li>$e</li>";
        }
        echo '</ul></div>';
    }

    foreach ($muebles as $mueble) {
        echo '<div style="border:1px solid #aaa; padding:10px; margin:10px; border-radius:8px;">';
        echo '<h3>' . get_class($mueble) . '</h3>';
        echo '<pre>' . $mueble . '</pre>';
        echo '</div>';
    }
}
