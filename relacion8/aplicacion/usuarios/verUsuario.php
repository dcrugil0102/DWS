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
        'TEXTO' => "Nuevo usuario",
        'LINK' => "/aplicacion/usuarios/verUsuario.php"
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

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($usuario);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($usuario)
{


?>
    <h1>Nuevo Usuario:</h1>

    <label>Nick:</label>
    <input type="text" name="nick" value="<?= $usuario['nick'] ?>" readonly><br><br>

    <label>Nombre completo:</label>
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" readonly> <br><br>

    <label>NIF:</label>
    <input type="text" name="nif" value="<?= $usuario['nif'] ?>" readonly><br><br>

    <label>Dirección:</label>
    <input type="text" name="direccion" value="<?= $usuario['direccion'] ?>" readonly><br><br>

    <label>Población:</label>
    <input type="text" name="poblacion" value="<?= $usuario['poblacion'] ?>" readonly><br><br>

    <label>Provincia:</label>
    <input type="text" name="provincia" value="<?= $usuario['provincia'] ?>" readonly><br><br>

    <label>Código postal:</label>
    <input type="text" name="cp" value="<?= $usuario['CP'] ?>" readonly><br><br>

    <label>Fecha de nacimiento:</label>
    <input type="date" name="fecha_nacimiento" value="<?= $usuario['fecha_nacimiento'] ?>" readonly><br><br>

    <label>Borrado:</label>
    <input type="checkbox" name="borrado" <?= $usuario['borrado'] ? 'checked' : '' ?> readonly><br><br>

    <div style="display:flex; align-items:center; gap: 10px;">
        <label>Foto:</label>
        <img class="imgUsu" src="/images/fotos/<?= $usuario['foto'] ?>" alt=""><br><br>
    </div>

    <br>

    <a href="/aplicacion/usuarios/index.php">Volver</a>
    <a href="modificarUsuario.php?codUsu=<?= $usuario['cod_usuario'] ?>">Modificar</a>
    <a href="borrarUsuario.php">Eliminar</a>

<?php
}
