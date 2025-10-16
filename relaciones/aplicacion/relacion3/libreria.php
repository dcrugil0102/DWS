<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 3",
        "LINK" => "/aplicacion/relacion3/libreria.php"
    ]
];

// *************CONTROLADOR********************

// ---------EJERCICIO 1 ----------

/**
 * Añade un valor al array y cuenta cuántas veces se ha llamado.
 *
 * @param array $array Array donde se guarda el valor
 * @param string $posicion Clave del array
 * @param int $num1 Valor a guardar
 * @param int &$num2 Número de llamada actual
 * @return bool True si va bien, False si hay error
 */
function cuentaVeces(array &$array, string $posicion, int $num1, int &$num2): bool
{
    static $cont = 0;

    if ($posicion == "2daw" || $posicion == "primera") {
        return false;
    }
    $array[$posicion] = $num1;

    $cont++;
    $num2 = $cont;

    return true;
}

// ---------EJERCICIO 2 ----------

function generarCadena(int $n = 10): string
{
    if ($n <= 0) {
        return false;
    }

    $cadena = "";
    for ($i = 0; $i < $n; $i++) {
        do {
            $random = mt_rand(48, 122);
        } while (($random >= 58 && $random <= 64) || ($random >= 91 && $random <= 96));

        $cadena .= chr($random);
    }

    return $cadena;
}

// ---------EJERCICIO 3 ----------

function operaciones(int $tipo, int $op1, int $op2, ...$ops)
{
    $result = 0;

    switch ($tipo) {
        case 1:
            $result = $op1 + $op2;
            foreach ($ops as $key => $value) {
                $result += $value;
            }
            return $result;
        case 2:
            $result = $op1 - $op2;
            foreach ($ops as $key => $value) {
                $result -= $value;
            }
            return $result;
        case 3:
            $result = $op1 * $op2;
            foreach ($ops as $key => $value) {
                $result *= $value;
            }
            return $result;
        default:
            $pares = $op2;
            $impares = $op1;
            foreach ($ops as $key => $value) {
                $key += 1;
                if ($key % 2 == 0) {
                    $pares += $value;
                } else {
                    $impares += $value;
                }
            }
            return $pares - $impares;
    }
}

// ---------EJERCICIO 4 ----------

function devuelve(int &$valor, int $n1 = 5, int $n2 = 10)
{
    $aux = $valor;
    $valor += $n1 + $n2;
    return $aux * $n1 * $n2;
}

// ---------EJERCICIO 5 ----------