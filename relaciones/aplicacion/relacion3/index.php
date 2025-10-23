<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/libreria.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 3",
        "LINK" => "/aplicacion/relacion3/"
    ]
];

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

    <h2>Relacion 3: Libreria de funciones</h2>

    <h3>Ejercicio 1:</h3>

    <?php

    $vector = array();
    $numero = 0;

    cuentaVeces($vector, "1osición", 7, $numero);
    echo "<p>";
    print_r($vector);
    echo "</p><p>Llamada número: $numero</p>";

    cuentaVeces($vector, "otra", 2, $numero);
    print_r($vector);
    echo "</p><p>Llamada número: $numero</p>";

    ?>

    <h3>Ejercicio 2:</h3>

    <?php

    echo "<p>" . generarCadena() . "</p>";

    ?>

    <h3>Ejercicio 3:</h3>

    <?php

    echo "<p>Opcion 1: ";
    echo operaciones(1, 2, 5, 7, 3, 4);
    echo "</p><p>Opcion 2: ";
    echo operaciones(2, 10, 2, 5);
    echo "</p><p>Opcion 3: ";
    echo operaciones(3, 2, 3, 4);
    echo "</p><p>Cualquier otro caso: ";
    echo operaciones(5, 2, 5, 7, 3, 4);
    ?>

    <h3>Ejercicio 4:</h3>

    <?php
    $valor = 2;
    $resultado = devuelve($valor, 3, 5);
    echo "<p>Con los tres parámetros: Valor = $valor, Resultado = $resultado</p>";

    $valor = 7;
    $resultado = devuelve($valor);
    echo "<p>Solo el primer parámetro: Valor = $valor, Resultado = $resultado</p>";

    $valor = 1;
    $resultado = devuelve($valor, 6);
    echo "<p>Primer y segundo parámetro: Valor = $valor, Resultado = $resultado</p>";

    $valor = 3;
    $resultado = devuelve(valor: $valor, n2: 7);
    echo "<p>Primer y tercer parámetro: Valor = $valor, Resultado = $resultado</p>";

    ?>

    <h3>Ejercicio 5:</h3>

    <?php

    echo hacerOperacion("resta", 3, 1);

    ?>

    <h3>Ejercicio 6:</h3>

    <?php

    echo "<p>Con funciones flecha:</p>";
    echo "<p>Suma: " . llamadaAFuncion(1, 2, fn($a, $b) => $a + $b) . "</p>";
    echo "<p>Resta: " . llamadaAFuncion(5, 3, fn($a, $b) => $a - $b) . "</p>";
    echo "<p>Multiplicación: " . llamadaAFuncion(4, 6, fn($a, $b) => $a * $b) . "</p>";

    // --- Con funciones anónimas ---
    echo "<p>Con funciones anónimas:</p>";
    $suma = function ($a, $b) {
        return $a + $b;
    };
    $resta = function ($a, $b) {
        return $a - $b;
    };
    $multi = function ($a, $b) {
        return $a * $b;
    };

    echo "<p>Suma: " . llamadaAFuncion(1, 2, $suma) . "</p>";
    echo "<p>Resta: " . llamadaAFuncion(5, 3, $resta) . "</p>";
    echo "<p>Multiplicación: " . llamadaAFuncion(4, 6, $multi) . "</p>";

    ?>

    <h3>Ejercicio 7:</h3>

<?php

    $vector = array("uno", "grande", "caminos", "a");
    ordenar($vector);
    print_r($vector);
}
