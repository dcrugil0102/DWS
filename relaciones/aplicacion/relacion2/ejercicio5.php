<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion2",
        "LINK" => "/aplicacion/relacion2"
    ],
    [
        "TEXTO" => "Ejercicio5",
        "LINK" => "/aplicacion/relacion2/ejercicio5.php"
    ]
];

// ***************** CONTROLADOR **************************

$texto = <<<HTML
<h1>Hola Mundo</h1>
<p>Esto es un texto con números como 123 y 45.</p>
<div>ejemplo@mail.com o prueba@empresa.es</div>
HTML;

$patronEtiquetas = "/<\.+>/";
$patronNumeros   = "/\d+/";
$patronEmail     = "/[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}/";

preg_match_all($patronEtiquetas, $texto, $etiquetas, PREG_OFFSET_CAPTURE);
preg_match_all($patronNumeros, $texto, $numeros, PREG_OFFSET_CAPTURE);
preg_match_all($patronEmail, $texto, $emails, PREG_OFFSET_CAPTURE);

// *******************************************************

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($texto, $etiquetas, $numeros, $emails);
finCuerpo();

// **********************************************************

function cabecera() {}

function cuerpo($texto, $etiquetas, $numeros, $emails)
{
?>
    <h1>Ejercicio 5:</h1>

    <h2>Texto original:</h2>
    <pre><?= htmlspecialchars($texto) ?></pre>

    <h2>Etiquetas encontradas:</h2>
    <ul>
        <?php foreach ($etiquetas[0] as $et): ?>
            <li>Posición <?= $et[1] ?>: <?= htmlspecialchars($et[0]) ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Números encontrados:</h2>
    <ul>
        <?php foreach ($numeros[0] as $num): ?>
            <li>Posición <?= $num[1] ?>: <?= $num[0] ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Emails encontrados:</h2>
    <ul>
        <?php foreach ($emails[0] as $em): ?>
            <li>Posición <?= $em[1] ?>: <?= $em[0] ?></li>
        <?php endforeach; ?>
    </ul>
<?php
}
