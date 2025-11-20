<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

if (!$acceso->hayUsuario()) {
    header("Location: /aplicacion/acceso/login.php");
}

if(!$acceso->puedePermiso(1)){
    paginaError("No tienes permisos");
    exit();
}

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Textos",
        "LINK" => "/aplicacion/texto/verTextos.php"
    ]
];

$texto = '';
$textos = $_SESSION['textos'] ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto = $_POST['texto'] ?? '';

    $nuevoTexto = new RegistroTexto($texto);
    $textos[] = $nuevoTexto;

    $_SESSION['textos'] = $textos;

    if (isset($_POST['limpiar'])) {
        $_SESSION['textos'] = [];

        header("Location: verTextos.php");
    }
}

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($textos);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($textos)
{
?>
    <h1>Textos</h1>

    <form action="verTextos.php" method="post">
        <label for="texto">Introduce tu texto</label><br>
        <textarea cols="50" rows="5" name="texto" id="texto"></textarea>

        <br>

        <button type="submit">Añadir</button><br><br>
        <textarea cols="50" rows="10" name="textos" id="textos" readonly><?php
        foreach ($textos as $texto) {
            echo $texto . PHP_EOL;
        }
        ?></textarea>
    </form>
    <form action="verTextos.php" method="post">
        <button type="submit" name="limpiar">Limpiar textos</button>
    </form>
<?php
}
