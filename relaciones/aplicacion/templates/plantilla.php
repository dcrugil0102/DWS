<?php
function paginaError(string $mensaje)
{
    header("HTTP/1.0 404 $mensaje");
    inicioCabecera("PRACTICA");
    finCabecera();
    inicioCuerpo("ERROR");
    echo "<br />\n";
    echo $mensaje;
    echo "<br />\n";
    echo "<br />\n";
    echo "<br />\n";
    echo "<a href='/index.php'>Ir a la pagina principal</a>\n";

    finCuerpo();
}
function inicioCabecera(string $titulo)
{
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <!-- Always force latest IE rendering engine (even in
intranet) & Chrome Frame
 Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible"
            content="IE=edge,chrome=1">
        <title><?php echo $titulo ?></title>
        <meta name="description" content="">
        <meta name="author" content="Administrador">
        <meta name="viewport" content="width=device-width; initialscale=1.0">
        <!-- Replace favicon.ico & apple-touch-icon.png in the root
of your domain and delete these references -->
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="stylesheet" type="text/css"
            href="/style/base.css">
    <?php
}
function finCabecera()
{
    ?>
    </head>
<?php
}
function inicioCuerpo(string $cabecera)
{
    global $acceso;

    $barraUbi = [];
?>

    <body>
        <header>
            <h1 id="titulo"><?php echo $cabecera; ?></h1>

            <div id="barraLogin">

            </div>
            <nav id="barraMenu">
                <ul>
                    <li><a href="/index.php">Inicio</a></li>
                    <li><a href="/aplicacion/tests/index.php">Pruebas</a></li>
                    <li><a href="/aplicacion/relacion1/index.php">Relacion 1</a></li>
                    <li><a href="/aplicacion/relacion2/index.php">Relacion 2</a></li>
                </ul>
            </nav>
        </header>
        <div id="barraUbicacion">
            <?php
            if ($barraUbi) {
                foreach ($barraUbi as $elemento) {
                    if (isset($elemento["TEXTO"]) && ($elemento["LINK"])) {
                        if ($elemento["LINK"]) {
                            echo "<a href=\"{$elemento["LINK"]}\">";
                            echo $elemento["TEXTO"];
                        }
                        if ($elemento["LINK"]) {
                            echo "<a href=\"{$elemento["LINK"]}\">";
                            echo "</a>";
                            echo "➤ ";
                        }
                    }
                }
            }
            ?>
        </div>
        <main>
        <?php
    }
    function finCuerpo()
    {
        ?>
            <br />
            <br />
        </main>
        <footer>
            <hr width="90%" />
            <p>
                &copy; Copyright by Damián Cruz Gil
            </p>
        </footer>
        </div>
    </body>

    </html>
<?php
    }
