<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$muebles = [
    new MuebleTradicional("Silla elegante", 1, 120.5, 20, "S02"),
    new MuebleTradicional("Mesa comedor", 2, 350.75, 80, "S05"),
    new MuebleTradicional("Armario clásico", 3, 600.25, 100, "A10"),
    new MuebleReciclado("Banco reciclado", 4, 50, "EcoWood", "España", 2022, "01/01/2021", "31/12/2035", 99.5),
    new MuebleReciclado("Lámpara eco", 5, 85, "LightCo", "Francia", 2021, "01/01/2020", "31/12/2040", 60.9),
    new MuebleReciclado("Estantería reciclada", 6, 75, "GreenWood", "Italia", 2023, "01/01/2023", "31/12/2042", 110.2)
];

$indice = isset($_GET['indice']) ? intval($_GET['indice']) : -1;
if ($indice < 0 || $indice >= count($muebles)) {
    die("Índice de mueble inválido");
}

$mueble = $muebles[$indice];
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        if (!$mueble->setNombre($_POST['nombre'])) throw new Exception("Nombre inválido");
        if (!$mueble->setPrecio(floatval($_POST['precio']))) throw new Exception("Precio inválido");
        if (!$mueble->setMaterialPrincipal(intval($_POST['material']))) throw new Exception("Material inválido");

        if (!empty($_POST['pais']) && strlen($_POST['pais']) <= 20) {
            $mueble->setPais($_POST['pais']);
        } else throw new Exception("País inválido");

        $anio = intval($_POST['anio']);
        if ($anio >= 2020 && $anio <= (int)date("Y")) {
            $mueble->setAnio($anio);
        } else throw new Exception("Año inválido");

        if ($mueble instanceof MuebleTradicional) {
            $peso = floatval($_POST['peso']);
            if ($peso >= 15 && $peso <= 300) $mueble->setPeso($peso);
            else throw new Exception("Peso inválido");

            $mueble->setSerie($_POST['serie'] ?? $mueble->getSerie());
        } else {
            $porcentaje = intval($_POST['porcentaje']);
            if ($porcentaje >= 0 && $porcentaje <= 100) $mueble->setPorcentajeReciclado($porcentaje);
            else throw new Exception("Porcentaje reciclado inválido");
        }

        $mensaje = "Mueble modificado correctamente!";
    } catch (Exception $e) {
        $mensaje = "Error: " . $e->getMessage();
    }
}

inicioCabecera("Modificar Mueble");
finCabecera();
inicioCuerpo("Modificar Mueble");
?>

<h2>Modificar Mueble: <?php echo $mueble->getNombre(); ?></h2>
<?php
if ($mensaje) {
    echo "<p style='color:green;'>$mensaje</p>";
}
?>

<form method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $mueble->getNombre(); ?>" maxlength="40"><br><br>

    <label>Precio (€):</label>
    <input type="number" step="0.01" name="precio" value="<?php echo $mueble->getPrecio(); ?>"><br><br>

    <label>Material:</label>
    <select name="material">
        <?php
        foreach (MuebleBase::MATERIALES_POSIBLES as $id => $mat) {
            $sel = ($id == $mueble->getMaterialPrincipal()) ? "selected" : "";
            echo "<option value='$id' $sel>$mat</option>";
        }
        ?>
    </select><br><br>

    <label>País:</label>
    <input type="text" name="pais" value="<?php echo $mueble->getPais(); ?>" maxlength="20"><br><br>

    <label>Año:</label>
    <input type="number" name="anio" value="<?php echo $mueble->getAnio(); ?>"><br><br>

    <?php
    if ($mueble instanceof MuebleTradicional) {
        echo '<label>Peso (kg):</label>';
        echo '<input type="number" step="0.1" name="peso" value="' . $mueble->getPeso() . '"><br><br>';
        echo '<label>Serie:</label>';
        echo '<input type="text" name="serie" value="' . $mueble->getSerie() . '"><br><br>';
    } else {
        echo '<label>Porcentaje reciclado (%):</label>';
        echo '<input type="number" name="porcentaje" value="' . $mueble->getPorcentajeReciclado() . '"><br><br>';
    }
    ?>

    <button type="submit">Guardar Cambios</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && strpos($mensaje, "Error") === false) {
    echo "<h3>Resumen del mueble modificado:</h3>";
    echo "<pre>" . $mueble->__toString() . "</pre>";
}
?>

<br>
<a href="index.php" target="_parent">Volver a la página principal</a>

<?php
finCuerpo();
?>