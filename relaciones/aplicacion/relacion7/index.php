<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

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
$arrayPuntos = [];

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
    
    // Crear punto y añadirlo al array

    if (empty($errores)) {
       try {
        $arrayPuntos[] = new Punto($valores['cordX'], $valores['cordY'], $valores['color'], $valores['grosor']);
    } catch (Exception $err) {
        $errores['error'] = $err->getMessage();
    }
    
}


inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($valores, $errores, $arrayPuntos);
finCuerpo();



// ************************** VISTA *****************************

function cabecera() {}


function cuerpo($valores, $errores, $arrayPuntos)
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
            <option value="" disabled selected>Escoge color</option>
            <?php
                foreach (Punto::COLORES as $colorIngles => $color) {
                        $selected = ($valores['color'] ?? '') == $color['nombre'] ? 'selected' : '';
                echo "<option value='{$color['nombre']}' $selected>{$color['nombre']}</option>";
                } 
             ?>
        </select>
        <span class="error"><?= $errores['color'] ?? '' ?></span><br>

        <label for="grosor">Escoge el grosor</label>

        <input type="radio" name="grosor" id="fino" value="fino" <?= ($valores['grosor'] ?? '') == 'fino' ? 'checked' : '' ?>>
        <label for="fino">Fino</label>

        <input type="radio" name="grosor" id="medio" value="medio" <?= ($valores['grosor'] ?? '') == 'medio' ? 'checked' : '' ?>>
        <label for="medio">Medio</label>

        <input type="radio" name="grosor" id="gordo" value="gordo" <?= ($valores['grosor'] ?? '') == 'gordo' ? 'checked' : '' ?>>
        <label for="gordo">Gordo</label>

        <span class="error"><?= $errores['grosor'] ?? '' ?></span><br>

        <button type="submit">Guardar</button>
    </form>

<?php
                // print_r($arrayPuntos);
}
}