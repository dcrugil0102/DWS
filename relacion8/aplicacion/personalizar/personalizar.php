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
        "TEXTO" => "Personalizar",
        "LINK" => "/aplicacion/personalizar/personalizar.php"
    ]
];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!$acceso->puedePermiso(2)) {
        paginaError("No tienes permisos");
        exit();
    }
    setcookie('color_fondo', $_POST['fondo'], time() + (10 * 365 * 24 * 3600), '/');
    setcookie('color_texto', $_POST['texto'], time() + (10 * 365 * 24 * 3600), '/');

    header("Location: personalizar.php");
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
    <h1>Personaliza tu página</h1>

    <form action="personalizar.php" method="post">
        <label for="fondo">Escoge el color del fondo</label>
        <select name="fondo" id="fondo">
            <?php foreach (COLORESFONDO as $color => $value) {
                $seleccionado = ($value == $_COOKIE['color_fondo']) ? 'selected' : '';
                echo "<option value='$value' $seleccionado>$color</option>";
            } ?>
        </select>

        <br>

        <label for="texto">Escoge el color del texto</label>
        <select name="texto" id="texto">
            <?php foreach (COLORESTEXTO as $color => $value) {
                $seleccionado = ($value == $_COOKIE['color_texto']) ? 'selected' : '';
                echo "<option value='$value' $seleccionado>$color</option>";
            } ?>
        </select>

        <br>

        <button type="submit">Guardar</button>
    </form>
<?php
}
