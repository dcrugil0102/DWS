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
cuerpo($contador, $COLECCIONES, $acceso);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($contador, $COLECCIONES, $acceso)
{
?>
    <p>Estas en el inicio. <br> Valor del contador: <?= $contador ?></p>

    <h2>Mostrar Colecciones</h2>

    <textarea name="colecciones" id="colecciones" cols="75" rows="10"><?php 
            foreach ($COLECCIONES as $key => $value) {
                echo $value . PHP_EOL;

                if ($acceso->hayUsuario()) {
                    foreach ($COLECCIONES as $coleccion) {
                        foreach ($coleccion->dameLibros() as $nombre => $libro) {
                            echo "\t-$nombre:" . PHP_EOL;
                            foreach ($libro as $key => $value) {
                                echo "\t\t-$key : $value" . PHP_EOL;
                            }
                        }
                    }
                }
            }?>
    </textarea>

    <h2>Modifica coleccion:</h2>

    <form action="/aplicacion/colecciones/modificar.php" method="post">
        <label for="colecciones">Elige la colección:</label>
        <select name="colecciones" id="colecciones">
            <?php 
                foreach ($COLECCIONES as $key => $value) {
                    echo "<option value='$key'>$value</option>";
                }
            ?>
            <option value="NaN">No existe</option>
        </select>
        <button type="submit" name="index">Modificar</button>
    </form>

    <h2>Envía colección:</h2>

    <form action="/aplicacion/colecciones/enviar.php" method="post">
        <label for="colecciones">Elige la colección:</label>
        <select name="colecciones" id="colecciones">
            <?php 
                foreach ($COLECCIONES as $key => $value) {
                    echo "<option value='$key'>$value</option>";
                }
            ?>
            <option value="NaN">No existe</option>
        </select>
        <label for="descargar">Descargar</label>
        <input type="checkbox" name="descargar" id="descargar">
        <button type="submit" name="index">Enviar</button>
    </form>
<?php
}
