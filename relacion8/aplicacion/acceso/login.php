<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ]
];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
}

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo();
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo()
{
?>
    <form action="login.php" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario">

        <label for="usuario">Contraseña:</label>
        <input type="password" name="contrasenia" id="contrasenia">
    </form>
<?php
}
