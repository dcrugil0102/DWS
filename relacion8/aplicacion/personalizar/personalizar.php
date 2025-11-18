<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ]
];

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
    <h1>Personaliza tu página</h1>

    <form action="personalizar.php" method="post">
        <label for="fondo">Escoge el color del fondo</label>
        <select name="fondo" id="fondo">
            <?php foreach (COLORESFONDO as $color => $value) {
                echo "<option value="$value">$color</option>";
            } ?>
        </select>
    </form>
<?php
}
