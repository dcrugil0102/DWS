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

$datos = [];

try {
    // Crear muebles tradicionales
    $m1 = new MuebleTradicional("Silla elegante", 1, 120.5, 20, "S02");
    $m1->añadir("color", "marrón", "altura", 100, "ancho", 500);
    $m1->añadir("material", "roble");
    $datos[] = $m1;

    $m2 = new MuebleTradicional("Mesa comedor", 2, 350.75, 80, "S05");
    $m2->añadir("color", "negro", "capacidad", "6 personas");
    $datos[] = $m2;

    // Crear muebles reciclados
    $m3 = new MuebleReciclado("Banco reciclado", 3, 50, 'Fabricante1', 'ESPAÑA', 2022, '01/11/2021', '31/12/2035', 100.5);
    $m3->añadir("color", "verde", "resistencia", "alta");
    $datos[] = $m3;

    $m4 = new MuebleReciclado("Lámpara eco", 5, 85, 'FMu: Fabricante 2', 'ESPAÑA', 2021, '01/01/2020', '31/12/2040', 60.9);
    $m4->añadir("voltaje", "220V", "ningunamas", true);
    $datos[] = $m4;

    // Probar método puedeCrear
    $m5 = null;
    $restantes = 0;
    $puede = $m4->puedeCrear($restantes);
    $datos['puedeCrear'] = [
        'resultado' => $puede ? 'Sí' : 'No',
        'restantes' => $restantes
    ];

    // Prueba de damePropiedad
    $valor = "";
    if ($m1->damePropiedad("nombre", 1, $valor)) {
        $datos['propiedad'] = "Nombre de m1: " . $valor;
    }
} catch (Exception $e) {
    $datos['error'] = $e->getMessage();
}


// ----- VISTA -----

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
    <h2>Pruebas de Muebles</h2>

    <?php
    if (isset($datos['error'])) {
        echo '<p style="color:red;">Error: ' . $datos['error'] . '</p>';
    }
    ?>

    <h3>Objetos creados:</h3>
    <pre>
<?php
    foreach ($datos as $d) {
        if ($d instanceof MuebleBase) {
            echo $d->__toString() . "\n---------------------\n";
        }
    }
?>
    </pre>

    <h3>Resultados adicionales:</h3>
    <pre>
<?php
    if (isset($datos['puedeCrear'])) {
        echo "¿Se pueden crear más muebles? " . $datos['puedeCrear']['resultado'] . "\n";
        echo "Restantes: " . $datos['puedeCrear']['restantes'] . "\n";
    }

    if (isset($datos['propiedad'])) {
        echo $datos['propiedad'] . "\n";
    }


?>
    </pre>

<?php
}
