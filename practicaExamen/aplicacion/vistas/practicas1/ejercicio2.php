<?php
echo "Ejercicio 2";
echo "<br>";
echo "<br>";

echo "LANZAMIENTO DE UN DADO";
echo "<br>";
echo "<br>";

$nLanzmientos = 50;
$dado = 0;
$array = [
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0
];
for ($i = 1; $i <= $nLanzmientos; $i++) {
    $dado = rand(1, 6);
    echo "Lanzamiento " . $i . " del dado: " . $dado . "<br />";
    $array[$dado]++;
}
echo "<br />";
echo "Resultados:<br />";
foreach ($array as $clave => $valor) {
    $porcentaje = ($valor / $nLanzmientos) * 100;
    echo "el numero " . $clave . " ha salido " . $valor . " veces, con un porcentaje del " . number_format($porcentaje, 2) . " %<br />";
}
echo "<br>";
echo CHTML::link("volver", Sistema::app()->generaURL(["practicas1", "miindice"]));