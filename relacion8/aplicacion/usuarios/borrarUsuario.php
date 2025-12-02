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

// COJEMOS EL COD DEL GET Y BUSCAMOS EL USUARIO

$codUsu = $_GET['codUsu'];
$sentenciaDatosUsu = "SELECT * FROM usuarios WHERE cod_usuario = '$codUsu'";
$usuario = $conexion->query($sentenciaDatosUsu)->fetch_assoc();

if ($usuario === null) {
    paginaError("Usuario no encontrado");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bool = $usuario['borrado'];
    $conexion->query("UPDATE usuarios set borrado = !$bool WHERE cod_usuario = '$codUsu'");
    $aclbd->setBorrado($usuario['cod_usuario'], !$bool);

    header("Location: /aplicacion/usuarios/verUsuario.php?codUsu=$codUsu");
}

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
    <span><?= $usuario['borrado'] ? 'Si' : 'No' ?></span><br><br>

    <div style="display:flex; align-items:center; gap: 10px;">
        <label>Foto:</label>
        <img class="imgUsu" src="/images/fotos/<?= $usuario['foto'] ?>" alt=""><br><br>
    </div>

    <br>

    <form action="borrarUsuario.php?codUsu=<?= $usuario['cod_usuario'] ?>" method="post">
        <label for="">Estas seguro de que quieres <?= $usuario['borrado'] ? ' restaurar ' : ' eliminar ' ?> a <?= $usuario['nick'] ?>?</label>
        <button class="boton" type="submit">Si</button>
        <a class="botonNo" href="verUsuario.php?codUsu=<?= $usuario['cod_usuario'] ?>" style="background-color: white; color: black; border: 1px solid black;">No</a>
    </form>

    <a href="/aplicacion/usuarios/index.php">Volver</a>

<?php
}
