<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Modificar coleccion",
        "LINK" => "/aplicacion/colecciones/modificar.php"
    ]
];

$valores = [
    'nombre' => '',
    'fecha' => '',
    'tematica' => 10
];

$errores = [];
$coleccion = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['index'])) {
        $coleccion = $COLECCIONES[$_POST['colecciones']];
    }

    if (isset($_POST['modificar'])) {

        //  VALIDACIONES

        $valores['nombre'] = $_POST['nombre'] ?? '';
        $valores['fecha'] = $_POST['fecha'] ?? '';
        $valores['tematica'] = $_POST['tematica'] ?? 10;

        if (!$coleccion->set_nombre($valores['nombre'])) {
            $errores['nombre'] = "Nombre incorrecto";
        }
        
        if (!$coleccion->set_fecha_alta($valores['fecha'])) {
            $errores['fecha'] = "Fecha incorrecta";
        }

        if (!$coleccion->set_tematica($valores['tematica'])) {
            $errores['tematica'] = "tematica incorrecta";
        }
        
    }
}


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
    <h1>Modificar Coleccion</h1>

    <form action="modificar.php" method="post">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <span class="error"></span><br><br>

        <label for="nombre">Fecha de alta: </label>
        <input type="text" name="fecha" id="fecha">
        <span class="error"></span><br><br>

        <label for="nombre">Temática: </label>
        <select name="tematica" id="tematica">
            <?php 
                foreach (Coleccion::TEMATICAS as $nombre => $valor) {
                    echo "<option value='$valor'>$nombre</option>";
                }
            ?>
        </select><br><br>

        <button type="submit" name="modificar">Modificar</button>
        
    </form>
<?php
}
