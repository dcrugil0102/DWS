<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ]
];

$texto = '';
$textos = $_SESSION['textos'] ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto = $_POST['texto'] ?? '';

    $nuevoTexto = new RegistroTexto($texto);
    $textos[] = $nuevoTexto;

    $_SESSION['textos'] = $textos;
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
        <label for="texto">Introduce tu texto</label>
        <textarea name="texto" id="texto"></textarea>

        <button type="submit">Añadir</button>
        <textarea name="textos" id="textos">
            <?php foreach ($textos as $texto) {
                echo $texto . PHP_EOL;
            } ?>
        </textarea>
    </form>
<?php
}
