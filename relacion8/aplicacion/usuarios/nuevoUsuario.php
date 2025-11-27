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
    ]
];

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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // VALIDACIONES

    // Nick
    if (!validaCadena($_POST['nick'], 50, '')) {
        $errores['nick'] = "El nick no puede superar los 50 carácteres";
    } else {
        $valores['nick'] = $_POST['nick'];
    }

    // Nombre completo
    if (!validaCadena($_POST['nombre'], 50, '')) {
        $errores['nombre'] = "El nombre no puede superar los 50 carácteres";
    } else {
        $valores['nombre'] = $_POST['nombre'];
    }

    // NIF
    if (!validaExpresion($_POST['nif'], "^\d{8}a-zA-z]$", "")) {
        $errores['nif'] = "NIF Inválido.";
    } else {
        $valores['nif'] = $_POST['nif'];
    }

    // Dirección
    if (!validaCadena($_POST['direccion'], 50, '')) {
        $errores['direccion'] = "La dirección no puede superar los 50 carácteres";
    } else {
        $valores['direccion'] = $_POST['direccion'];
    }

    // Población
    if (!validaCadena($_POST['poblacion'], 30, '')) {
        $errores['poblacion'] = "La población no puede superar los 30 carácteres";
    } else {
        $valores['poblacion'] = $_POST['poblacion'];
    }

    // Provincia
    if (!validaCadena($_POST['provincia'], 30, '')) {
        $errores['provincia'] = "La provincia no puede superar los 30 carácteres";
    } else {
        $valores['provincia'] = $_POST['provincia'];
    }

    // Código postal
    if (!validaCadena($_POST['cp'], 5, '00000')) {
        $errores['cp'] = "El código postal no puede superar los 5 carácteres";
    } else {
        $valores['cp'] = $_POST['cp'];
    }

    // Fecha de nacimiento
    if (!validaFecha($_POST['fecha_nacimiento'], "")) {
        $errores['fecha_nacimiento'] = "La fecha de nacimiento no es válida";
    } else {
        $valores['fecha_nacimiento'] = $_POST['fecha_nacimiento'];
    }

    // Borrado (checkbox)
    $valores['borrado'] = isset($_POST['borrado']) ? 1 : 0;

    // Foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $valores['foto'] = $_FILES['foto'];
    } else {
        $errores['foto'] = "Debes subir una foto";
    }

}

$usuarios = $conexion->query("SELECT * FROM usuarios");

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
    <h1>Nuevo usuario:</h1>
     <form action="nuevoUsuario" method="post">
        <label>Nick:</label>
        <input type="text" name="nick"><br><br>

        <label>Nombre completo:</label>
        <input type="text" name="nombre_completo"><br><br>

        <label>NIF:</label>
        <input type="text" name="nif"><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion"><br><br>

        <label>Población:</label>
        <input type="text" name="poblacion"><br><br>

        <label>Provincia:</label>
        <input type="text" name="provincia"><br><br>

        <label>Código postal:</label>
        <input type="text" name="cp"><br><br>

        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento"><br><br>

        <label>Borrado:</label>
        <input type="checkbox" name="borrado" value="1"><br><br>

        <label>Foto:</label>
        <input type="file" name="foto"><br><br>

        <button type="submit">Agregar</button>
     </form>
<?php
}
