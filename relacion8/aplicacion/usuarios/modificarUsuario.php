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

    <form action="modificarUsuario.php" method="post">
        <label>Nick:</label>
        <input type="text" name="nick" value="<?= $usuario['nick'] ?>"><br><br>

        <label>Nombre completo:</label>
        <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>"> <br><br>

        <label>NIF:</label>
        <input type="text" name="nif" value="<?= $usuario['nif'] ?>"><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?= $usuario['direccion'] ?>"><br><br>

        <label>Población:</label>
        <input type="text" name="poblacion" value="<?= $usuario['poblacion'] ?>"><br><br>

        <label>Provincia:</label>
        <input type="text" name="provincia" value="<?= $usuario['provincia'] ?>"><br><br>

        <label>Código postal:</label>
        <input type="text" name="cp" value="<?= $usuario['CP'] ?>"><br><br>

        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= $usuario['fecha_nacimiento'] ?>"><br><br>

        <label>Borrado:</label>
        <input type="checkbox" name="borrado" <?= $usuario['borrado'] ? 'checked' : '' ?>><br><br>

        <div style="display:flex; align-items:center; gap: 10px;">
            <label>Foto:</label>
            <img class="imgUsu" src="/images/fotos/<?= $usuario['foto'] ?>" alt="" style="width:10vh;"><br><br>
        </div>

        <button type="submit">Modificar</button>
    </form>

    <br>

    <a href="/aplicacion/usuarios/index.php">Volver</a>
    <a href="borrarUsuario.php">Eliminar</a>

<?php
}
