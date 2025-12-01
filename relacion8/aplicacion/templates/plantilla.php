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
            href="/styles/base4.css">
    <?php
}
function finCabecera()
{
    ?>
    </head>
<?php
}

if (!isset($_COOKIE['color_fondo'])) {
    setcookie('color_fondo', COLORESFONDO['blanco'], time() + (10 * 365 * 24 * 3600), '/');
}

if (!isset($_COOKIE['color_texto'])) {
    setcookie('color_texto', COLORESTEXTO['negro'], time() + (10 * 365 * 24 * 3600), '/');
}
function inicioCuerpo(string $cabecera, array $barraUbi = [])
{
    global $acceso;

    $colorFondo = $_COOKIE['color_fondo'] ?? COLORESFONDO['blanco'];
    $colorTexto = $_COOKIE['color_texto'] ?? COLORESTEXTO['negro'];
?>

    <body style="background-color: <?= $colorFondo ?>; color:<?= $colorTexto ?>;">
        <header>
            <h1 id="titulo"><?php echo $cabecera; ?></h1>

            <nav id="barraMenu">
                <ul>
                    <li><a href="/index.php">Inicio</a></li>
                    <?php if ($acceso->hayUsuario()) {
                    ?>
                        <li><a href="/aplicacion/tests/index.php">Pruebas</a></li>
                        <li><a href="/aplicacion/personalizar/personalizar.php">Personalizar</a></li>
                        <li><a href="/aplicacion/texto/verTextos.php">Textos</a></li>
                        <li><a href="/aplicacion/usuarios/index.php">Usuarios</a></li>
                    <?php
                    } ?>
                </ul>
            </nav>

            <div id="barraLogin">
                <?php if ($acceso->hayUsuario()) {
                ?>
                    <form action="/aplicacion/acceso/login.php" method="post">
                        <div>
                            <p><?= $acceso->getNombre() ?></p>
                            <button class="salir" name="salir" type="submit">Salir</button>
                        </div>
                    </form>
                <?php
                } else {
                    echo "<a href='/aplicacion/acceso/login.php' class='acceso'>Log In</a>";
                } ?>
            </div>

        </header>
        <div id="barraUbicacion">
            <?php
            if ($barraUbi) {
                $ultimo = end($barraUbi);
                foreach ($barraUbi as $elemento) {
                    if (!empty($elemento["TEXTO"])) {
                        if (!empty($elemento["LINK"])) {
                            echo "<a href=\"{$elemento["LINK"]}\">{$elemento["TEXTO"]}</a>";
                        } else {
                            echo "<span>{$elemento["TEXTO"]}</span>";
                        }
                        if ($elemento !== $ultimo) {
                            echo " <span>➤</span> ";
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
