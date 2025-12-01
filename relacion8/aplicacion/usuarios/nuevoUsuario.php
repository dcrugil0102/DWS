<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        'TEXTO' => "Usuarios",
        'LINK' => "/aplicacion/usuarios"
    ],
    [
        'TEXTO' => "Agregar usuario",
        'LINK' => "/aplicacion/usuarios/nuevoUsuario.php"
    ]
];

if (!$acceso->hayUsuario()) {
    header("Location: /aplicacion/acceso/login.php");
}

if (!$acceso->puedePermiso(2) && !$acceso->puedePermiso(3)) {
    paginaError("No tienes permisos");
    exit();
}

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$valores = [
    'nick' => '',
    'nombre' => '',
    'nif' => '',
    'direccion' => '',
    'poblacion' => '',
    'provincia' => '',
    'cp' => '',
    'fecha_nacimiento' => '',
    'borrado' => '',
    'foto' => ''
];
$errores = [];
$noErrores = false;

$nicksUsuarios = [];

while ($fila = $usuarios->fetch_assoc()) {
    foreach ($fila as $key => $value) {
        if ($key == 'nick') {
            $nicksUsuarios[] = $value;
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // VALIDACIONES

    $noErrores = false;

    $valores['nick'] = $_POST['nick'] ?? '';
    $valores['nombre'] = $_POST['nombre'] ?? '';
    $valores['nif'] = $_POST['nif'] ?? '';
    $valores['direccion'] = $_POST['direccion'] ?? '';
    $valores['poblacion'] = $_POST['poblacion'] ?? '';
    $valores['provincia'] = $_POST['provincia'] ?? '';
    $valores['cp'] = $_POST['cp'] ?? '';
    $valores['fecha_nacimiento'] = $_POST['fecha_nacimiento'] ?? '';
    $valores['borrado'] = isset($_POST['borrado']) ? 1 : 0;
    $valores['foto'] = $_FILES['foto'];

    // Nick
    if (!validaCadena($_POST['nick'], 50, '') || empty($_POST['nick'])) {
        $errores['nick'] = "El nick no puede superar los 50 carácteres ni estar vacío";
    } else if (validaRango($_POST['nick'], $nicksUsuarios, 1)) {
        $errores['nick'] = 'Ese nick ya existe!';
    }

    // Nombre completo
    if (!validaCadena($_POST['nombre'], 50, '') || empty($_POST['nombre'])) {
        $errores['nombre'] = "El nombre no puede superar los 50 carácteres ni estar vacío";
    }

    // NIF
    if (!validaExpresion($_POST['nif'], "/^\d{8}[A-Za-z]$/", "") || empty($_POST['nif'])) {
        $errores['nif'] = "NIF Inválido.";
    }

    // Dirección
    if (!validaCadena($_POST['direccion'], 50, '') || empty($_POST['direccion'])) {
        $errores['direccion'] = "La dirección no puede superar los 50 carácteres ni estar vacío";
    }

    // Población
    if (!validaCadena($_POST['poblacion'], 30, '') || empty($_POST['poblacion'])) {
        $errores['poblacion'] = "La población no puede superar los 30 carácteres ni estar vacío";
    }

    // Provincia
    if (!validaCadena($_POST['provincia'], 30, '') || empty($_POST['provincia'])) {
        $errores['provincia'] = "La provincia no puede superar los 30 carácteres ni estar vacío";
    }

    // Código postal
    if (!validaCadena($_POST['cp'], 5, '00000') || empty($_POST['cp'])) {
        $errores['cp'] = "El código postal no puede superar los 5 carácteres ni estar vacío";
    }

    // Fecha de nacimiento
    if (empty($_POST['fecha_nacimiento'])) {
        $errores['fecha_nacimiento'] = "La fecha de nacimiento no es válida";
    }

    // Foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        if (!getimagesize($valores['foto']['tmp_name'])) {
            $errores['foto'] = "Formato no permitido";
        } else
            $valores['foto'] = $_FILES['foto'];

            // CAMBIAR NOMBRE A LA FOTO
            $nombreFoto = $valores['nick'] . "." . pathinfo($valores['foto']['name'])['extension'];
            
            // SUBIR LA IMAGEN A LA CARPETA IMAGENES
            move_uploaded_file($valores['foto']['tmp_name'], __DIR__ . "/../../images/fotos/$nombreFoto");
    } else {
        $nombreFoto = "defecto.jpg";
    }

    if (empty($errores)) {

        // INSERTAR LOS VALORES EN LA BD

        $sentenciaIngresarUsu = "INSERT INTO USUARIOS (nick, nombre, nif, direccion, poblacion, provincia, CP, fecha_nacimiento, borrado, foto)
                                VALUES (
                                        '{$valores['nick']}',
                                        '{$valores['nombre']}',
                                        '{$valores['nif']}',
                                        '{$valores['direccion']}',
                                        '{$valores['poblacion']}',
                                        '{$valores['provincia']}',
                                        '{$valores['cp']}',
                                        '{$valores['fecha_nacimiento']}',
                                        {$valores['borrado']},
                                        '$nombreFoto'
                                        )";

        $conexion->query($sentenciaIngresarUsu);

        $noErrores = true;

        // VER USUARIO
        $sentenciaCodUsu = "SELECT cod_usuario FROM usuarios WHERE nick = '{$valores['nick']}';";
        $codUsu = $conexion->query($sentenciaCodUsu)->fetch_assoc()['cod_usuario'];

        header("Location: /aplicacion/usuarios/verUsuario.php?codUsu=$codUsu");
    }
}

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($usuarios, $valores, $errores, $noErrores);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($usuarios, $valores, $errores, $noErrores)
{


?>
    <h1>Nuevo usuario:</h1>
    <form action="nuevoUsuario.php" method="post" enctype="multipart/form-data">
        <label>Nick:</label>
        <input type="text" name="nick" value="<?= htmlspecialchars($valores['nick'] ?? '') ?>">
        <span class="error"><?= $errores['nick'] ?? '' ?></span><br><br>

        <label>Nombre completo:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($valores['nombre'] ?? '') ?>">
        <span class="error"><?= $errores['nombre'] ?? '' ?></span><br><br>

        <label>NIF:</label>
        <input type="text" name="nif" value="<?= htmlspecialchars($valores['nif'] ?? '') ?>">
        <span class="error"><?= $errores['nif'] ?? '' ?></span><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?= htmlspecialchars($valores['direccion'] ?? '') ?>">
        <span class="error"><?= $errores['direccion'] ?? '' ?></span><br><br>

        <label>Población:</label>
        <input type="text" name="poblacion" value="<?= htmlspecialchars($valores['poblacion'] ?? '') ?>">
        <span class="error"><?= $errores['poblacion'] ?? '' ?></span><br><br>

        <label>Provincia:</label>
        <input type="text" name="provincia" value="<?= htmlspecialchars($valores['provincia'] ?? '') ?>">
        <span class="error"><?= $errores['provincia'] ?? '' ?></span><br><br>

        <label>Código postal:</label>
        <input type="text" name="cp" value="<?= htmlspecialchars($valores['cp'] ?? '') ?>">
        <span class="error"><?= $errores['cp'] ?? '' ?></span><br><br>

        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($valores['fecha_nacimiento'] ?? '') ?>">
        <span class="error"><?= $errores['fecha_nacimiento'] ?? '' ?></span><br><br>

        <label>Borrado:</label>
        <input type="checkbox" name="borrado" <?= ($valores['borrado'] ? 'checked' : '') ?>>
        <span class="error"><?= $errores['borrado'] ?? '' ?></span><br><br>

        <label>Foto:</label>
        <input type="file" accept="image/jpeg, image/png" name=" foto">
        <span class="error"><?= $errores['foto'] ?? '' ?></span><br><br>

        <button type="submit">Agregar</button>
        <span class="valido"><?= $noErrores ? "Usuario registrado exitosamente." : "" ?></span>
    </form>

    <br>

    <a href="/aplicacion/usuarios/index.php">Volver</a>
<?php
}
