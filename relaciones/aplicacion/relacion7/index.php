<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/bookstores/validacion.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/aplicacion/relacion7/index.php"
    ]
];

// ********************* CONTROLADOR *****************************

$valores = [
    'cordX' => 0,
    'cordY' => 0,
    "color" => "",
    'grosor' => ""
];

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Asignacion de valores

    $valores['cordX'] = (int)$_POST['cordX'];
    $valores['cordY'] = (int)$_POST['cordY'];
    $valores['color'] = $_POST['color'] ?? '';
    $valores['grosor'] = $_POST['grosor'] ?? '';

    // Validaciones

    if (!validaEntero($valores['cordX'], 0, 500, 0)) {
        $errores['cordX'] = 'La coordenada X debe ser entre 0 y 500';
    }

    if (!validaEntero($valores['cordY'], 0, 500, 0)) {
        $errores['cordY'] = 'La coordenada Y debe ser entre 0 y 500';
    }

    if ($valores['color'] == "") {
        $errores['color'] = 'Debes seleccionar un color.';
    }

    if ($valores['grosor'] == "") {
        $errores['grosor'] = 'Debes seleccionar un grosor.';
    }
}


inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($valores, $errores);
finCuerpo();



// ************************** VISTA *****************************

function cabecera() {}


function cuerpo($valores, $errores)
{
?>
    <h1>Relacion 7:</h1>

    <form action="index.php" method="post">
        <label for="cordX">Introduce X:</label>
        <input type="number" name="cordX" value="<?= htmlspecialchars($valores['cordX'] ?? "") ?>">
        <span class="error"><?= $errores['cordX'] ?? '' ?></span><br>

        <label for="cordY">Introduce Y:</label>
        <input type="number" name="cordY" value="<?= htmlspecialchars($valores['cordX'] ?? "") ?>">
        <span class="error"><?= $errores['cordY'] ?? '' ?></span><br>

        <label for="color">Escoge el color:</label>
        <select name="color">

        </select>
        <span class="error"><?= $errores['color'] ?? '' ?></span><br>

        <label for="grosor">Escoge el grosor</label>

        <input type="radio" name="grosor" id="fino" <?= ($valores['grosor'] ?? '') == 'fino' ? 'checked' : '' ?>>
        <label for="grosor">Fino</label>

        <input type="radio" name="grosor" id="medio" <?= ($valores['grosor'] ?? '') == 'medio' ? 'checked' : '' ?>>
        <label for="grosor">Medio</label>

        <input type="radio" name="grosor" id="gordo" <?= ($valores['grosor'] ?? '') == 'gordo' ? 'checked' : '' ?>>
        <label for="grosor">Gordo</label>

        <span class="error"><?= $errores['grosor'] ?? '' ?></span><br>

        <button type="submit">Guardar</button>
    </form>
<?php
}
