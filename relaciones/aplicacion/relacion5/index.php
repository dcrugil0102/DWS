<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/librerias/val_normal.php");
include_once(dirname(__FILE__) . "/librerias/val_filter.php");
include_once(dirname(__FILE__) . "/../../scripts/bookstores/validacion.php");

// ****************** CONTROLADOR ***********************

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK"  => "/index.php",
    ],
    [
        "TEXTO" => "Relacion 5",
        "LINK"  => "/aplicacion/relacion5",
    ],
];

$errores = [];
$valores = [
    'nombre' => '',
    'password' => '',
    'fecha_nacimiento' => '',
    'fecha_carnet_dia' => '',
    'fecha_carnet_mes' => '',
    'fecha_carnet_anio' => '',
    'hora_levantarse' => '',
    'estado' => '',
    'estudios' => [],
    'hermanos' => 0,
    'sueldo' => 1100
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ---------- VALIDACIONES ----------
    // Nombre
    $valores['nombre'] = $_POST['nombre'] ?? '';
    if (!validaCadena($valores['nombre'], 25, '') || strtoupper($valores['nombre'][0] ?? '') === 'H') {
        $errores['nombre'] = "Nombre no válido o empieza por H";
    } else {
        $valores['nombre'] = strtoupper($valores['nombre']);
    }

    // Contraseña
    $valores['password'] = $_POST['password'] ?? '';
    $patron_pass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\$_\-;<>@]).{8,15}$/';
    if (!preg_match($patron_pass, $valores['password'])) {
        $errores['password'] = "Contraseña no cumple requisitos";
    }

    // Fecha de nacimiento
    $valores['fecha_nacimiento'] = $_POST['fecha_nacimiento'] ?? '';
    if (!validaFecha($valores['fecha_nacimiento'], '')) {
        $errores['fecha_nacimiento'] = "Fecha de nacimiento no válida";
    }

    // Fecha de carnet
    $valores['fecha_carnet_dia'] = $_POST['fecha_carnet_dia'] ?? '';
    $valores['fecha_carnet_mes'] = $_POST['fecha_carnet_mes'] ?? '';
    $valores['fecha_carnet_anio'] = $_POST['fecha_carnet_anio'] ?? '';
    $fecha_carnet_str = "{$valores['fecha_carnet_dia']}/{$valores['fecha_carnet_mes']}/{$valores['fecha_carnet_anio']}";
    if (!validaFecha($fecha_carnet_str, '')) {
        $errores['fecha_carnet'] = "Fecha de carnet no válida";
    } else {
        $fecha_nac = new DateTime($valores['fecha_nacimiento']);
        $fecha_nac->modify('+18 years');
        $fecha_carnet = DateTime::createFromFormat('d/m/Y', $fecha_carnet_str);
        if ($fecha_carnet < $fecha_nac) {
            $errores['fecha_carnet'] = "Debe ser mayor de 18 años para carnet";
        }
    }

    // Hora de levantarse
    $valores['hora_levantarse'] = $_POST['hora_levantarse'] ?? '';
    if (!validaHora($valores['hora_levantarse'], '')) {
        $errores['hora_levantarse'] = "Hora no válida";
    }

    // Estado 
    $valores['estado'] = (int)($_POST['estado'] ?? 0);
    if (!validaRango($valores['estado'], [1, 2, 3, 4])) {
        $errores['estado'] = "Estado no válido";
    }

    // Estudios 
    $valores['estudios'] = $_POST['estudios'] ?? [];
    if (empty($valores['estudios']) || in_array(6, $valores['estudios'])) {
        $errores['estudios'] = "Debe seleccionar al menos un estudio válido";
    }
    if (in_array(0, $valores['estudios']) && count($valores['estudios']) > 1) {
        $errores['estudios'] = "Si selecciona 'sin estudios', no puede seleccionar otros";
    }

    // Hermanos
    $valores['hermanos'] = (int)($_POST['hermanos'] ?? 0);
    validaEntero($valores['hermanos'], 0, 20, 0);

    // Sueldo
    $valores['sueldo'] = (float)($_POST['sueldo'] ?? 1100);
    validaReal($valores['sueldo'], 1000, 150000, 1100);

    // Si no hay errores mostramos resumen
    if (empty($errores)) {
        $mostrarResumen = true;
    } else {
        $mostrarResumen = false;
    }
}

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($valores, $errores, $mostrarResumen ?? false);
finCuerpo();

// **********************************************************

function cabecera() {}

function cuerpo($valores, $errores, $mostrarResumen = false)
{
    if ($mostrarResumen) {
        echo "<h2>Resumen de datos:</h2>";
        echo "<pre>";
        print_r($valores);
        echo "</pre>";
        return;
    }
?>
    <h2>Formulario:</h2>
    <form method="post">
        Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($valores['nombre']) ?>">
        <?= $errores['nombre'] ?? '' ?><br>

        Contraseña: <input type="password" name="password">
        <?= $errores['password'] ?? '' ?><br>

        Fecha de nacimiento (dd/mm/aaaa): <input type="text" name="fecha_nacimiento" value="<?= htmlspecialchars($valores['fecha_nacimiento']) ?>">
        <?= $errores['fecha_nacimiento'] ?? '' ?><br>

        Fecha de carnet:
        <input type="text" name="fecha_carnet_dia" size="2" value="<?= $valores['fecha_carnet_dia'] ?>"> /
        <input type="text" name="fecha_carnet_mes" size="2" value="<?= $valores['fecha_carnet_mes'] ?>"> /
        <input type="text" name="fecha_carnet_anio" size="4" value="<?= $valores['fecha_carnet_anio'] ?>">
        <?= $errores['fecha_carnet'] ?? '' ?><br>

        Hora de levantarse: <input type="text" name="hora_levantarse" value="<?= htmlspecialchars($valores['hora_levantarse']) ?>">
        <?= $errores['hora_levantarse'] ?? '' ?><br>

        Estado:<br>
        <?php
        $opciones_estado = [1 => 'Estudiante', 2 => 'En paro', 3 => 'Trabajando', 4 => 'Jubilado', 5 => 'Incorrecta'];
        foreach ($opciones_estado as $k => $v) {
            $checked = ($valores['estado'] == $k) ? 'checked' : '';
            echo "<input type='radio' name='estado' value='$k' $checked>$v<br>";
        }
        echo $errores['estado'] ?? '';
        ?><br>

        Estudios:<br>
        <?php
        $opciones_estudios = [0 => 'Sin estudios', 1 => 'Primaria', 2 => 'Secundaria', 3 => 'Bachillerato', 4 => 'Ciclo', 5 => 'Universitario', 6 => 'Incorrecta'];
        foreach ($opciones_estudios as $k => $v) {
            $checked = in_array($k, $valores['estudios']) ? 'checked' : '';
            echo "<input type='checkbox' name='estudios[]' value='$k' $checked>$v<br>";
        }
        echo $errores['estudios'] ?? '';
        ?><br>

        Hermanos: <input type="number" name="hermanos" value="<?= $valores['hermanos'] ?>"><br>
        Sueldo: <input type="number" name="sueldo" value="<?= $valores['sueldo'] ?>" step="0.01"><br>

        <input type="submit" value="Enviar">
    </form>
<?php
}
