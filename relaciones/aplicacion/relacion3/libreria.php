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

/**
 * Genera una cadena aleatoria de longitud $n compuesta por caracteres alfanuméricos.
 *
 * @param int $n Longitud de la cadena a generar. Por defecto es 10.
 * @return string Cadena aleatoria generada. Si $n <= 0, devuelve false.
 */
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

/**
 * Realiza diferentes operaciones matemáticas según el tipo especificado.
 *
 * @param int $tipo Tipo de operación a realizar:
 *                  1 - Suma todos los operandos.
 *                  2 - Resta todos los operandos en secuencia.
 *                  3 - Multiplica todos los operandos.
 *                  Otro valor - Suma los valores en posiciones pares e impares por separado (empezando desde $op1 como impar y $op2 como par)
 *                               y devuelve la diferencia entre la suma de pares y la suma de impares.
 * @param int $op1 Primer operando.
 * @param int $op2 Segundo operando.
 * @param int ...$ops Operandos adicionales (opcional).
 * @return int Resultado de la operación solicitada.
 */
function operaciones(int $tipo, int $op1, int $op2, ...$ops): int
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

/**
 * Modifica el valor dado sumando $n1 y $n2, y devuelve el producto del valor original, $n1 y $n2.
 *
 * @param int &$valor Referencia al valor entero que se va a modificar.
 * @param int $n1 Opcional. Primer número a sumar a $valor. Por defecto es 5.
 * @param int $n2 Opcional. Segundo número a sumar a $valor. Por defecto es 10.
 * @return int El producto del valor original, $n1 y $n2.
 */
function devuelve(int &$valor, int $n1 = 5, int $n2 = 10): int
{
    $aux = $valor;
    $valor += $n1 + $n2;
    return $aux * $n1 * $n2;
}

// ---------EJERCICIO 5 ----------

/**
 * Suma dos números enteros y devuelve el resultado.
 *
 * @param int $n1 El primer número a sumar.
 * @param int $n2 El segundo número a sumar.
 * @return int La suma de $n1 y $n2.
 */
function suma(int $n1, int $n2): int
{
    return $n1 + $n2;
}

/**
 * Resta dos números enteros.
 *
 * @param int $n1 El primer número.
 * @param int $n2 El segundo número.
 * @return int La diferencia entre $n1 y $n2.
 */
function resta(int $n1, int $n2): int
{
    return $n1 - $n2;
}

/**
 * Multiplica dos números enteros y devuelve el resultado.
 *
 * @param int $n1 El primer número a multiplicar.
 * @param int $n2 El segundo número a multiplicar.
 * @return int El resultado de la multiplicación de $n1 y $n2.
 */
function multiplicacion(int $n1, int $n2): int
{
    return $n1 * $n2;
}

/**
 * Realiza una operación matemática entre dos números enteros.
 *
 * @param string $op El nombre de la operación a realizar: "suma", "resta" o "multiplicacion".
 * @param int $n1 El primer operando.
 * @param int $n2 El segundo operando.
 * @return int|false El resultado de la operación, o false si la operación no es válida.
 */
function hacerOperacion(string $op, int $n1, int $n2): int
{
    if (!in_array($op, ["suma", "resta", "multiplicacion"])) {
        return false;
    }

    return $op($n1, $n2);
}

// ---------EJERCICIO 6 ----------

/**
 * Llama a una función pasada como parámetro con dos argumentos enteros.
 *
 * @param int $n1 El primer número entero que se pasa a la función.
 * @param int $n2 El segundo número entero que se pasa a la función.
 * @param callable $funcion La función que se va a llamar, que acepta dos argumentos enteros.
 * @return mixed El valor devuelto por la función llamada.
 */
function llamadaAFuncion(int $n1, int $n2, callable $funcion): mixed
{
    return $funcion($n1, $n2);
}

// ---------EJERCICIO 7 ----------

/**
 * Ordena un array de cadenas de texto en orden descendente según la longitud de cada cadena.
 *
 * @param array $vector Referencia al array de cadenas a ordenar.
 * @return array El array ordenado por longitud de las cadenas (de mayor a menor).
 */
function ordenar(array &$vector): array
{
    $ordena = function ($a, $b) {
        if (strlen($a) == strlen($b)) return 0;
        return (strlen($a) < strlen($b)) ? 1 : -1;
    };

    usort($vector, $ordena);
    return $vector;
}
