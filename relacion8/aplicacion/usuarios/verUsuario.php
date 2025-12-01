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

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($usuarios);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($usuarios)
{


?>
    <h1>Nuevo Usuario:</h1>

    <label>Nick:</label>
    <input type="text" name="nick" value="" disabled><br><br>

    <label>Nombre completo:</label>
    <input type="text" name="nombre" value="" readonly> <br><br>

    <label>NIF:</label>
    <input type="text" name="nif" value="" readonly><br><br>

    <label>Dirección:</label>
    <input type="text" name="direccion" value="" readonly><br><br>

    <label>Población:</label>
    <input type="text" name="poblacion" value="" readonly><br><br>

    <label>Provincia:</label>
    <input type="text" name="provincia" value="" readonly><br><br>

    <label>Código postal:</label>
    <input type="text" name="cp" value="" readonly><br><br>

    <label>Fecha de nacimiento:</label>
    <input type="date" name="fecha_nacimiento" value="" readonly><br><br>

    <label>Borrado:</label>
    <input type="checkbox" name="borrado" readonly><br><br>

    <label>Foto:</label>
    <img src="" alt=""><br><br>

<?php
}
