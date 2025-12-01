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
        'TEXTO' => "Modificar usuario",
        'LINK' => "/aplicacion/usuarios/modificarUsuario.php"
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

$codUsu = $_GET['codUsu'];
$sentenciaDatosUsu = "SELECT * FROM usuarios WHERE cod_usuario = '$codUsu'";
$usuario = $conexion->query($sentenciaDatosUsu)->fetch_assoc();

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

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // VALIDACIONES

    $valores['nombre'] = $_POST['nombre'] ?? '';
    $valores['nif'] = $_POST['nif'] ?? '';
    $valores['direccion'] = $_POST['direccion'] ?? '';
    $valores['poblacion'] = $_POST['poblacion'] ?? '';
    $valores['provincia'] = $_POST['provincia'] ?? '';
    $valores['cp'] = $_POST['cp'] ?? '';
    $valores['fecha_nacimiento'] = $_POST['fecha_nacimiento'] ?? '';
    $valores['borrado'] = isset($_POST['borrado']) ? 1 : 0;
    $valores['foto'] = $_FILES['foto'] ?? '';

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
            $nombreFoto = $usuario['nick'] . "." . pathinfo($valores['foto']['name'])['extension'];
            
            // SUBIR LA IMAGEN A LA CARPETA IMAGENES
            move_uploaded_file($valores['foto']['tmp_name'], __DIR__ . "/../../images/fotos/$nombreFoto");
    }

    // MODIFICAR USUARIO

    if (empty($errores)) {
        $sentenciaUpdate = "UPDATE usuarios
                            set nombre = '{$valores['nombre']}',
                            nif = '{$valores['nif']}',
                            direccion = '{$valores['direccion']}',
                            poblacion = '{$valores['poblacion']}',
                            provincia = '{$valores['provincia']}',
                            CP = '{$valores['cp']}',
                            fecha_nacimiento = '{$valores['fecha_nacimiento']}',
                            borrado = '{$valores['borrado']}',
                            foto = '{$usuario['foto']}'
                            WHERE cod_usuario = '$codUsu'";
    }

    $conexion->query($sentenciaUpdate);
}

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($usuario, $valores, $errores);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($usuario, $valores, $errores)
{


?>
    <h1>Nuevo Usuario:</h1>

    <form action="modificarUsuario.php?codUsu=<?= $usuario['cod_usuario'] ?>" method="post" enctype="multipart/form-data">
        <label>Nick:</label>
        <input type="text" name="nick" value="<?= $usuario['nick'] ?>" readonly><br><br>

        <label>Nombre completo:</label>
        <input type="text" name="nombre" value="<?= empty($valores['nombre']) ? $usuario['nombre'] : $valores['nombre'] ?>"> 
        <span class="error"><?= $errores['nombre'] ?? '' ?></span><br><br>

        <label>NIF:</label>
        <input type="text" name="nif" value="<?= empty($valores['nif']) ? $usuario['nif'] : $valores['nif'] ?>">
        <span class="error"><?= $errores['nif'] ?? '' ?></span><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?= empty($valores['direccion']) ? $usuario['direccion'] : $valores['direccion'] ?>">
        <span class="error"><?= $errores['direccion'] ?? '' ?></span><br><br>

        <label>Población:</label>
        <input type="text" name="poblacion" value="<?= empty($valores['poblacion']) ? $usuario['poblacion'] : $valores['poblacion'] ?>">
        <span class="error"><?= $errores['poblacion'] ?? '' ?></span><br><br>

        <label>Provincia:</label>
        <input type="text" name="provincia" value="<?= empty($valores['provincia']) ? $usuario['provincia'] : $valores['provincia'] ?>">
        <span class="error"><?= $errores['provincia'] ?? '' ?></span><br><br>

        <label>Código postal:</label>
        <input type="text" name="cp" value="<?= empty($valores['cp']) ? $usuario['CP'] : $valores['cp'] ?>">
        <span class="error"><?= $errores['cp'] ?? '' ?></span><br><br>

        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= empty($valores['fecha_nacimiento']) ? $usuario['fecha_nacimiento'] : $valores['fecha_nacimiento'] ?>">
        <span class="error"><?= $errores['fecha_nacimiento'] ?? '' ?></span><br><br>

        <label>Borrado:</label>
        <input type="checkbox" name="borrado" <?= empty($valores['borrado']) ? ($usuario['borrado'] ? 'checked' : '') : ($valores['borrado'] ? 'checked' : '') ?>><br><br>

        <div style="display:flex; align-items:center; gap: 10px;">
            <label>Foto:</label>
            <img class="imgUsu" src="/images/fotos/<?= $usuario['foto'] ?>"><br><br>
        </div><br>
        <input type="file" accept="image/jpeg, image/png" name=" foto">
        <span class="error"><?= $errores['foto'] ?? '' ?></span><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>

    <a href="/aplicacion/usuarios/index.php">Volver</a>
    <a href="borrarUsuario.php">Eliminar</a>

<?php
}
