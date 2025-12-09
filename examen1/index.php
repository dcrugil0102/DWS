<?php
include_once(dirname(__FILE__) . "/cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ]
];

$contador = $_COOKIE['contador'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $contador = $contador + 2;

        if ($contador % 3 == 0) {
            $acceso->registrarUsuario("MULTIPLO", "MULTIPLO", [1 => true]);
        }
    } else if(isset($_POST['salir'])){
        $acceso->quitarRegistroUsuario();
    }
}

setcookie('contador', $contador, time() + (10 * 365 * 24 * 3600), '/');

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($contador);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($contador)
{
?>
    <p>Estas en el inicio. <br> Valor del contador: <?= $contador ?></p>

    <h2>Mostrar Colecciones</h2>

    <textarea name="colecciones" id="colecciones" cols="50" rows="10"></textarea>
<?php
}
