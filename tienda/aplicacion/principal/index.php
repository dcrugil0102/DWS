<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ]
];

// ----- CONTROLADOR -----
$datos = [];

try {
    // Crear muebles
    $muebles = [
        new MuebleTradicional("Silla elegante", 1, 120.5, 20, "S02"),
        new MuebleTradicional("Mesa comedor", 2, 350.75, 80, "S05"),
        new MuebleTradicional("Armario clásico", 3, 600.25, 100, "A10"),
        new MuebleReciclado("Banco reciclado", 4, 50, "EcoWood", "España", 2022, "01/01/2021", "31/12/2035", 99.5),
        new MuebleReciclado("Lámpara eco", 5, 85, "LightCo", "Francia", 2021, "01/01/2020", "31/12/2040", 60.9),
        new MuebleReciclado("Estantería reciclada", 6, 75, "GreenWood", "Italia", 2023, "01/01/2023", "31/12/2042", 110.2)
    ];

    // Añadir características
    $muebles[0]->añadir("color", "marrón", "material", "roble");
    $muebles[1]->añadir("color", "negro", "capacidad", "6 personas");
    $muebles[3]->añadir("color", "verde", "resistencia", "alta");
    $muebles[5]->añadir("color", "gris", "capacidad", "10kg");

    $datos['muebles'] = $muebles;

    // Procesar formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["indice"])) {
        $indice = intval($_POST["indice"]);

        if ($indice >= 0 && $indice < count($muebles)) {
            $mueble = $muebles[$indice];

            if (isset($_POST["mostrar"])) {
                $datos['accion'] = "mostrar";
                $propiedades = $mueble->dameListaPropiedades();
                $detalle = "";
                foreach ($propiedades as $prop => $valor) {
                    $res = "";
                    $mueble->damePropiedad($prop, 2, $res);
                    $detalle .= $prop . ": " . $res . "\n";
                }
                $datos['muebleSeleccionado'] = $detalle;
            }

            if (isset($_POST["modificar"])) {
                $mueble->añadir("estado", "actualizado");
                $datos['accion'] = "modificar";
                $detalle = "";
                $propiedades = $mueble->dameListaPropiedades();
                foreach ($propiedades as $prop => $valor) {
                    $res = "";
                    $mueble->damePropiedad($prop, 2, $res);
                    $detalle .= $prop . ": " . $res . "\n";
                }
                $datos['muebleSeleccionado'] = $detalle;
            }
        }
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
    <h2>Listado de Muebles</h2>

    <?php
    if (isset($datos['error'])) {
        echo '<p style="color:red;">Error: ' . $datos['error'] . '</p>';
    }

    $muebles = $datos['muebles'];
    ?>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse; width:100%;">
        <tr style="background-color:#f2f2f2;">
            <th>Índice</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Precio (€)</th>
            <th>País</th>
            <th>Año</th>
            <th>Material</th>
        </tr>

        <?php

        for ($i = 0; $i < count($muebles); $i++) {
            $mueble = $muebles[$i];
            if ($mueble instanceof MuebleBase) {
                $resNombre = $resPrecio = $resPais = $resAnio = $resMat = "";
                $mueble->damePropiedad("nombre", 2, $resNombre);
                $mueble->damePropiedad("Precio", 2, $resPrecio);
                $mueble->damePropiedad("pais", 2, $resPais);
                $mueble->damePropiedad("anio", 2, $resAnio);
                $mueble->damePropiedad("MaterialPrincipal", 2, $resMat);

                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . get_class($mueble) . '</td>';
                echo '<td>' . $resNombre . '</td>';
                echo '<td>' . $resPrecio . '</td>';
                echo '<td>' . $resPais . '</td>';
                echo '<td>' . $resAnio . '</td>';
                echo '<td>' . (isset(MuebleBase::MATERIALES_POSIBLES[$resMat]) ? MuebleBase::MATERIALES_POSIBLES[$resMat] : '-') . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </table>

    <hr>

    <form method="post" action="">
        <label for="indice">Selecciona un mueble:</label>
        <select name="indice" id="indice">
            <?php
            for ($i = 0; $i < count($muebles); $i++) {
                $resNombre = "";
                $muebles[$i]->damePropiedad("nombre", 2, $resNombre);
                echo '<option value="' . $i . '">' . $i . ' - ' . $resNombre . '</option>';
            }
            ?>
        </select>

        <br><br>
        <button type="submit" name="mostrar">Mostrar Mueble</button>
        <button type="button" onclick="window.open('modificarMueble.php?indice=' + document.getElementById('indice').value, 'Modificar', 'width=600,height=600')">Modificar Mueble</button>

    </form>

    <hr>

    <?php
    if (isset($datos['accion'])) {
        if ($datos['accion'] == "mostrar") {
            echo "<h3>Detalles del mueble seleccionado:</h3>";
            echo "<pre>" . $datos['muebleSeleccionado'] . "</pre>";
        } elseif ($datos['accion'] == "modificar") {
            echo "<h3>Mueble modificado correctamente:</h3>";
            echo "<pre>" . $datos['muebleSeleccionado'] . "</pre>";
        }
    }
    ?>
<?php
}
?>