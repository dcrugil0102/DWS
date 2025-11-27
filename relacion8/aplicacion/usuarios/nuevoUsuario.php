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

    $valores['nick'] = $_POST['nick'] ?? '';
    $valores['nombre'] = $_POST['nombre'] ?? '';
    $valores['nif'] = $_POST['nif'] ?? '';
    $valores['direccion'] = $_POST['direccion'] ?? '';
    $valores['poblacion'] = $_POST['poblacion'] ?? '';
    $valores['provincia'] = $_POST['provincia'] ?? '';
    $valores['cp'] = $_POST['cp'] ?? '';
    $valores['fecha_nacimiento'] = $_POST['fecha_nacimiento'] ?? '';
    $valores['borrado'] = isset($_POST['borrado']) ? 1 : 0;
    $valores['foto'] = $_FILES['foto'] ?? null;

    // Nick
    if (!validaCadena($_POST['nick'], 50, '') || empty($_POST['nick'])) {
        $errores['nick'] = "El nick no puede superar los 50 carácteres ni estar vacío";
    }

    // Nombre completo
    if (!validaCadena($_POST['nombre'], 50, '') || empty($_POST['nombre'])) {
        $errores['nombre'] = "El nombre no puede superar los 50 carácteres ni estar vacío";
    }

    // NIF
    if (!validaExpresion($_POST['nif'], "^\d{8}a-zA-z]$", "") || empty($_POST['nif'])) {
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
    if (!validaFecha($_POST['fecha_nacimiento'], "") || empty($_POST['fecha_nacimiento'])) {
        $errores['fecha_nacimiento'] = "La fecha de nacimiento no es válida";
    }

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
cuerpo($usuarios, $valores, $errores);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($usuarios, $valores, $errores)
{


?>
    <h1>Nuevo usuario:</h1>
     <form action="nuevoUsuario.php" method="post">
        <label>Nick:</label>
        <input type="text" name="nick" value="<?= htmlspecialchars($valores['nick'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['nick'] ?? '' ?></span>

        <label>Nombre completo:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($valores['nombre'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['nombre'] ?? '' ?></span>

        <label>NIF:</label>
        <input type="text" name="nif" value="<?= htmlspecialchars($valores['nif'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['nif'] ?? '' ?></span>

        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?= htmlspecialchars($valores['direccion'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['direccion'] ?? '' ?></span>

        <label>Población:</label>
        <input type="text" name="poblacion" value="<?= htmlspecialchars($valores['poblacion'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['poblacion'] ?? '' ?></span>

        <label>Provincia:</label>
        <input type="text" name="provincia" value="<?= htmlspecialchars($valores['provincia'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['provincia'] ?? '' ?></span>

        <label>Código postal:</label>
        <input type="text" name="cp" value="<?= htmlspecialchars($valores['cp'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['cp'] ?? '' ?></span>

        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($valores['fecha_nacimiento'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['fecha_nacimiento'] ?? '' ?></span>

        <label>Borrado:</label>
        <input type="checkbox" name="borrado" value="<?= htmlspecialchars($valores['borrado'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['borrado'] ?? '' ?></span>

        <label>Foto:</label>
        <input type="file" name="foto" value="<?= htmlspecialchars($valores['foto'] ?? '') ?>"><br><br>
        <span class="error"><?= $errores['foto'] ?? '' ?></span>

        <button type="submit">Agregar</button>
     </form>
<?php
}
