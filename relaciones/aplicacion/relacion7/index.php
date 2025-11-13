<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include_once(dirname(__FILE__) . "/global.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/aplicacion/relacion7/index.php"
    ]
];

$valores = [
    'cordX' => 0,
    'cordY' => 0,
    "color" => "",
    'grosor' => "",
    'archivo' => ""
];

$errores = [];

// Codigo que se ejecuta cuando se envia el formulario

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['formulario'] == 'agregar') {
        // Asignacion de valores del formulario

        $valores['cordX'] = (int) $_POST['cordX'];
        $valores['cordY'] = (int) $_POST['cordY'];
        $valores['color'] = $_POST['color'] ?? '';
        $valores['grosor'] = $_POST['grosor'] ?? '';

        // Validacion de los valores del formmulario

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
        } else {
            foreach (Punto::GROSORES as $key => $value) {
                if ($valores['grosor'] == $value) {
                    $valores['grosor'] = $key;
                }
            }
        }

        // Crear los puntos y añadirlos al fichero

        if (empty($errores)) {
            try {
                $punto = new Punto($valores['cordX'], $valores['cordY'], $valores['color'], $valores['grosor']);

                $arrayPuntos[] = $punto;

                $fic = fopen($nombrePunto, 'a');

                fputs($fic, $punto . PHP_EOL);

                fclose($fic);

                $valores = ['cordX' => '', 'cordY' => '', 'color' => '', 'grosor' => ''];
            } catch (Exception $err) {
                $errores['error'] = $err->getMessage();
            }
        }

        $img = recrearImg($arrayPuntos);
        imagejpeg($img, $nombreImg, 100);
        imagedestroy($img);
    } else if ($_POST['formulario'] == 'eliminar') {
        $puntoABorrar = $_POST['puntos'];
        array_splice($arrayPuntos, $puntoABorrar, 1);

        if (file_exists($nombrePunto)) {
            $lineas = file($nombrePunto);
            if (isset($lineas[$puntoABorrar])) {
                unset($lineas[$puntoABorrar]);
                file_put_contents($nombrePunto, $lineas);
            }
        }

        $img = recrearImg($arrayPuntos);
        imagejpeg($img, $nombreImg, 100);
        imagedestroy($img);
    } else if ($_POST['formulario'] == 'cargar') {

        if (isset($_FILES['archivo'])) {
            $nombreArchivo = $_FILES['archivo']['name'];
            $tmp = $_FILES['archivo']['tmp_name'];

            $colores = implode("|", array_keys(Punto::COLORES));
            $grosores = implode("|", Punto::GROSORES);

            move_uploaded_file($tmp, $nombreArchivo);
            $fic = fopen($nombreArchivo, "r");
            $ficPuntos = fopen("$nombrePunto", "a");
            while (($linea = fgets($fic)) !== false) {
                $linea = trim($linea);

                if (preg_match("/^([0-9]|[1-9][0-9]|[0-4][0-9]{2}|500);([0-9]|[1-9][0-9]|[0-4][0-9]{2}|500);(" . $colores . ");(" . $grosores . ")$/", $linea)) {
                    fputs($ficPuntos, $linea . PHP_EOL);
                }
            }
            fclose($ficPuntos);
            fclose($fic);

            $img = recrearImg($arrayPuntos);
            imagejpeg($img, $nombreImg, 100);
            imagedestroy($img);

            header("Location: " . $_SERVER['PHP_SELF'] . "?mensaje=punto+cargado");
        } else {
            $valores['archivo'] = 'Error al cargar el archivo';
        }
    }
}

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($valores, $errores, $nombrePunto, $nombreImg, $arrayPuntos);
finCuerpo();

function cabecera() {}

function cuerpo($valores, $errores, $nombrePunto, $nombreImg, $arrayPuntos)
{
?>
    <h1>Relacion 7:</h1>

    <form action="index.php" method="post">
        <input type="hidden" name="formulario" value="agregar">

        <label for="cordX">Introduce X:</label>
        <input type="number" name="cordX" value="<?= htmlspecialchars($valores['cordX'] ?? "") ?>">
        <span class="error"><?= $errores['cordX'] ?? '' ?></span><br>

        <label for="cordY">Introduce Y:</label>
        <input type="number" name="cordY" value="<?= htmlspecialchars($valores['cordY'] ?? "") ?>">
        <span class="error"><?= $errores['cordY'] ?? '' ?></span><br>

        <label for="color">Escoge el color:</label>
        <select name="color">
            <option value="" disabled selected>Escoge color</option>
            <?php
            foreach (Punto::COLORES as $colorIngles => $color) {
                $selected = ($valores['color'] ?? '') == $colorIngles ? 'selected' : '';
                echo "<option value='{$colorIngles}' $selected>{$color['nombre']}</option>";
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
    <br>

    <textarea name="puntos" id="puntos" rows="10" cols="50" readonly>
<?php
    if (!empty($nombrePunto) && file_exists($nombrePunto)) {
        echo file_get_contents($nombrePunto);
    } else {
        echo "No hay puntos guardados todavía.";
    }
?>
    </textarea>

    <form action="index.php" method="post">
        <input type="hidden" name="formulario" value="eliminar">

        <select name="puntos" id="puntos">
            <option value="" disabled selected>Elige Punto</option>
            <?php
            for ($i = 0; $i < count($arrayPuntos); $i++) {
                echo "<option value='$i'>{$i}º: {$arrayPuntos[$i]}</option>";
            }
            ?>

        </select>

        <button type="submit">Borrar</button>
    </form>

    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="formulario" value="cargar">

        <input type="file" name="archivo" id="archivo" accept=".txt"><br>
        <span class="error"><?= $valores['archivo'] ?? "" ?></span>

        <button type="submit">Cargar puntos</button>
    </form>

    <h3>Imagen :</h3>
    <img src="<?= $nombreImg ?>" alt="">
    <form action="imagen.php" method="post">
        <button type="submit">Descargar</button>
    </form>

<?php
}
