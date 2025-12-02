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

if (!$acceso->hayUsuario()) {
    header("Location: /aplicacion/acceso/login.php");
}

if (!$acceso->puedePermiso(2)) {
    paginaError("No tienes permisos");
    exit();
}

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['nick'])) {

        $ordenActual = $_POST['orden'] ?? 'ASC';

        $nuevoOrden = ($ordenActual === 'ASC') ? 'DESC' : 'ASC';

        $_POST['orden'] = $nuevoOrden;

        $usuarios = $conexion->query("SELECT * FROM usuarios ORDER BY nick $nuevoOrden");
    } else if (isset($_POST['provincia'])) {

        $ordenActual = $_POST['orden'] ?? 'ASC';

        $nuevoOrden = ($ordenActual === 'ASC') ? 'DESC' : 'ASC';

        $_POST['orden'] = $nuevoOrden;

        $usuarios = $conexion->query("SELECT * FROM usuarios ORDER BY provincia $nuevoOrden");
    } else if (isset($_POST['borrado'])) {

        $ordenActual = $_POST['orden'] ?? 'ASC';

        $nuevoOrden = ($ordenActual === 'ASC') ? 'DESC' : 'ASC';

        $_POST['orden'] = $nuevoOrden;

        $usuarios = $conexion->query("SELECT * FROM usuarios ORDER BY borrado $nuevoOrden");
    }
}

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION", $barraUbi);
cuerpo($usuarios);
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo($usuarios)
{


?>
    <h1>Usuarios:</h1>
    <table class="tabla">
        <tr>
            <th>Nick
                <form action="index.php" method="post" style="display: inline;">
                    <input type="hidden" name="orden" value="<?= $_POST['orden'] ?? 'ASC' ?>">
                    <button class="ordenar" type="submit" name="nick">
                        <i class="fa-solid fa-sort"></i>
                    </button>
                </form>
            </th>
            <th>Nombre completo</th>
            <th>NIF</th>
            <th>Dirección</th>
            <th>Población</th>
            <th>Provincia
                <form action="index.php" method="post" style="display: inline;">
                    <input type="hidden" name="orden" value="<?= $_POST['orden'] ?? 'ASC' ?>">
                    <button class="ordenar" type="submit" name="provincia">
                        <i class="fa-solid fa-sort"></i>
                    </button>
                </form>
            </th>
            <th>Código postal</th>
            <th>Fecha de nacimiento</th>
            <th>Borrado
                <form action="index.php" method="post" style="display: inline;">
                    <input type="hidden" name="orden" value="<?= $_POST['orden'] ?? 'ASC' ?>">
                    <button class="ordenar" type="submit" name="borrado">
                        <i class="fa-solid fa-sort"></i>
                    </button>
                </form>
            </th>
            <th>Foto</th>
        </tr>
        <?php
        $codUsu = '';
        while ($fila = $usuarios->fetch_assoc()) {
            echo "<tr>";
            foreach ($fila as $key => $value) {
                if ($key != 'cod_usuario') {
                    if ($key === 'borrado') {
                        echo "<td>" . ($value ? 'Si' : 'No') . "</td>";
                    } else if ($key === 'foto') {
                        echo "<td><img src='/images/fotos/" . $value . "'></td>";
                    } else
                        echo "<td>$value</td>";
                } else
                    $codUsu = $value;
            }
            echo "<td class='enlaces'>
                        <a href='verUsuario.php?codUsu=$codUsu'>Ver</a>
                        <a href='modificarUsuario.php?codUsu=$codUsu'>Modificar</a>
                        <a href='borrarUsuario.php?codUsu=$codUsu'>" . ($fila['borrado'] ? 'Restaurar' : 'Eliminar') . "</a>
                    </td>";
            echo "</tr>";
        }
        ?>
    </table><br>

    <a class="boton" href="nuevoUsuario.php">Agregar Usuario</a>
<?php
}
