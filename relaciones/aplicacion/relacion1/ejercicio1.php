<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

inicioCabecera("2DAW APLICACION");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera() {}


function cuerpo()
{

?>
    <h1>Ejercicio 1</h1>
    <h2>Funciones Math</h2>
    <h3>Round:</h3>
<?php
$n1 = 4.5;
$n2 = 4.4;
$n3 = 4.6;
echo "$n1 redondeado es: " . round($n1) . "<br>";
echo "$n2 redondeado es: " . round($n2) . "<br>";
echo "$n3 redondeado es: " . round($n3) . "<br>";
?>
<h3>Floor:</h3>
<?php
echo "$n1 redondeado hacia abajo es: " . floor($n1) . "<br>";
echo "$n2 redondeado hacia abajo es: " . floor($n2) . "<br>";
echo "$n3 redondeado hacia abajo es: " . floor($n3) . "<br>";
?>
<h3>Pow:</h3>
<?php
echo "2 elevado a 3 es: " . pow(2, 3) . "<br>";
?>
<h3>SQRT:</h3>
<?php
echo "La raiz cuadrada de 16 es: " . sqrt(16) . "<br>";
?>
<h3>Entero a hexadecimal</h3>
<?php
echo "255 en hexadecimal es: " . dechex(255) . "<br>";
?>
<h3>Base4 a 8</h3>
<?php
echo "123 en base 4 a base 8 es: " . base_convert(123, 4, 8) . "<br>";
?>
<h3>Coseno:</h3>
<?php
echo "El coseno de 60 es: " . cos(60) . "<br>";
?>
<h3>Log10</h3>
<?php
echo "El logaritmo en base 10 de 1000 es: " . log10(1000) . "<br>";
?>
<h3>Binario a decimal</h3>
<?php
echo "1101 = " . bindec(1101) . "<br>";
?>
<h3>Octal a decimal</h3>
<?php
echo "17 = " . octdec(17) . "<br>";
?>
<h3>Hexadecimal a decimal</h3>
<?php
echo "FF = " . hexdec("FF") . "<br>";
?>
}

