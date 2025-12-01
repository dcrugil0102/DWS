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
            <th>Nick</th>
            <th>Nombre completo</th>
            <th>NIF</th>
            <th>Dirección</th>
            <th>Población</th>
            <th>Provincia</th>
            <th>Código postal</th>
            <th>Fecha de nacimiento</th>
            <th>Borrado</th>
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
                        <a href='verUsuario.php?codUsu=$codUsu'>Ver</a> |
                        <a href='modificarUsuario.php?codUsu=$codUsu'>Modificar</a> |
                        <a href='borrarUsuario.php?codUsu=$codUsu'>Eliminar</a>
                    </td>";
            echo "</tr>";
        }
        ?>
    </table><br>

    <a class="boton" href="nuevoUsuario.php">Agregar Usuario</a>
<?php
}
