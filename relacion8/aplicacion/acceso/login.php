<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ]
];

$errores = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    if (!empty($usuario) && !empty($contrasenia)) {
        $acl->anadirUsuario($usuario, $usuario, $contrasenia, $acl->getCodRole('normales'));
        $acceso->registrarUsuario($usuario, $usuario, $acl->getPermisos($acl->getCodUsuario($usuario)));
    } else
        $errores['login'] = "Debes rellenar todos los campos.";
}

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($errores);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($errores)
{
?>
    <form action="login.php" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario">

        <br>

        <label for="usuario">Contraseña:</label>
        <input type="password" name="contrasenia" id="contrasenia">

        <span class="error"><?= $errores['login'] ?? '' ?></span>

        <br>
        <button type="submit">Acceder</button>

    </form>
<?php
}
