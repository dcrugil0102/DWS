<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ]
];

$acl = new ACLArray();

$errores = [];
$mensajes = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['acceder'])) {
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];

        if (!empty($usuario) && !empty($contrasenia)) {
            if ($acl->esValido($usuario, $contrasenia)) {
                $mensajes['login'] = "Login correcto, bienvenido $usuario.";
                $acceso->registrarUsuario($usuario, $usuario, $acl->getPermisos($acl->getCodUsuario($usuario)));
            } else {
                $errores['login'] = "Nombre o contraseña inválidos: $usuario y $contrasenia";
            }
        } else {$errores['login'] = "Debes rellenar todos los campos.";}

    }
    
    if(isset($_POST['salir'])){
        $acceso->quitarRegistroUsuario();
    }
}

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($errores, $mensajes);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($errores, $mensajes)
{
?>
    <form action="login.php" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario">

        <br>

        <label for="usuario">Contraseña:</label>
        <input type="password" name="contrasenia" id="contrasenia">

        <span class="error"><?= $errores['login'] ?? '' ?></span>
        <span class="valido"><?= $mensajes['login'] ?? '' ?></span>
        
        <br>
        <button type="submit" name="acceder">Acceder</button>

    </form>
<?php
}
