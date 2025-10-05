<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo();
finCuerpo();

function cabecera() {}

function cuerpo()
{

?>
    <h1>Fechas en PHP</h1>
    <h2>Usando funciones de fecha</h2>
<?php
    echo "Fecha actual (d/m/Y): " . date("d/m/Y") . "<br>";
    echo "Fecha actual (dia d, mes F, año Y, día de la semana l): " . date("d F Y l") . "<br>";
    echo "Hora actual (H:i:s): " . date("H:i:s") . "<br><br>";

    $fechaFija = strtotime("2024-03-29 12:45");
    echo "Fecha fija (d/m/Y): " . date("d/m/Y", $fechaFija) . "<br>";
    echo "Fecha fija (dia d, mes F, año Y, día de la semana l): " . date("d F Y l", $fechaFija) . "<br>";
    echo "Hora fija (H:i:s): " . date("H:i:s", $fechaFija) . "<br><br>";

    $fechaModificada = strtotime("-12 days -4 hours");
    echo "Fecha modificada (d/m/Y): " . date("d/m/Y", $fechaModificada) . "<br>";
    echo "Fecha modificada (dia d, mes F, año Y, día de la semana l): " . date("d F Y l", $fechaModificada) . "<br>";
    echo "Hora modificada (H:i:s): " . date("H:i:s", $fechaModificada) . "<br>";

    echo "<h2>Usando la clase DateTime</h2>";

    $ahora = new DateTime();
    echo "Fecha actual (d/m/Y): " . $ahora->format("d/m/Y") . "<br>";
    echo "Fecha actual (dia d, mes F, año Y, día de la semana l): " . $ahora->format("d F Y l") . "<br>";
    echo "Hora actual (H:i:s): " . $ahora->format("H:i:s") . "<br><br>";

    $fija = new DateTime("2024-03-29 12:45");
    echo "Fecha fija (d/m/Y): " . $fija->format("d/m/Y") . "<br>";
    echo "Fecha fija (dia d, mes F, año Y, día de la semana l): " . $fija->format("d F Y l") . "<br>";
    echo "Hora fija (H:i:s): " . $fija->format("H:i:s") . "<br><br>";

    $modificada = new DateTime();
    $modificada->modify("-12 days -4 hours");
    echo "Fecha modificada (d/m/Y): " . $modificada->format("d/m/Y") . "<br>";
    echo "Fecha modificada (dia d, mes F, año Y, día de la semana l): " . $modificada->format("d F Y l") . "<br>";
    echo "Hora modificada (H:i:s): " . $modificada->format("H:i:s") . "<br>";
}
