<?php

function validaEntero(int &$var, int $min, int $max, int $defecto): bool
{
    $var = (int)filter_var($var, FILTER_SANITIZE_NUMBER_INT);

    if (filter_var($var, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, 'max_range' => $max]]) !== false) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

function validaReal(float &$var, float $min, float $max, float $defecto): bool
{
    $var = (float)filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    if (filter_var($var, FILTER_VALIDATE_FLOAT) !== false && $var >= $min && $var <= $max) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

/**
 * Valida si una cadena representa una fecha válida en formato "d/m/Y".
 *
 * La función verifica si la cadena cumple con el formato "día/mes/año" (por ejemplo, "31/12/2024").
 * Si la fecha es válida, normaliza el formato y actualiza la variable por referencia.
 * Si la fecha no es válida, asigna el valor por defecto a la variable y retorna false.
 *
 * @param string &$var     Cadena que representa la fecha a validar. Se actualiza por referencia.
 * @param string $defecto  Valor por defecto que se asigna si la fecha no es válida.
 * @return bool            true si la fecha es válida y se ha normalizado; false en caso contrario.
 */
function validaFecha(string &$var, string $defecto): bool
{
    if (filter_var($var, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^\d{1,2}\/\d{1,2}\/\d{4}$/']])) {
        $temp = explode("/", $var);
        $dia = (int)$temp[0];
        $mes = (int)$temp[1];
        $anio = (int)$temp[2];

        if (checkdate($mes, $dia, $anio)) {
            $var = DateTime::createFromFormat("d/m/Y", $var)->format("d/m/Y");
            return true;
        } else {
            $var = $defecto;
            return false;
        }
    } else {
        $var = $defecto;
        return false;
    }
}

function validaHora(string &$var, string $defecto): bool
{
    if (filter_var($var, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^\d{1,2}\:\d{1,2}\:\d{1,2}$/']])) {

        $temp = explode(":", $var);

        if (count($temp) === 3) {
            $hora = str_pad($temp[0], 2, '0', STR_PAD_LEFT);
            $minuto = str_pad($temp[1], 2, '0', STR_PAD_LEFT);
            $segundo = str_pad($temp[2], 2, '0', STR_PAD_LEFT);

            $var = "$hora:$minuto:$segundo";
        }

        if ($hora >= 00 && $hora <= 23 && $minuto >= 00 && $minuto <= 59 && $segundo >= 00 && $segundo <= 59) {
            return true;
        } else {
            $var = $defecto;
            return false;
        }
    } else {
        $var = $defecto;
        return false;
    }
}

function validaEmail(string &$var, string $defecto): bool
{
    $var = filter_var($var, FILTER_SANITIZE_EMAIL);

    if (filter_var($var, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

/**
 * Valida la longitud máxima de una cadena (en bytes). Si la supera, asigna $defecto.
 *
 * @param string &$var   Cadena a validar (por referencia).
 * @param int    $longitud Longitud máxima permitida (bytes).
 * @param string $defecto  Valor por defecto si falla la validación.
 * @return bool True si cumple la longitud; false y $var = $defecto si no.
 */
function validaCadena(string &$var, int $longitud, string $defecto): bool
{

    $longitud_var = strlen($var);

    if (filter_var($longitud_var, FILTER_VALIDATE_INT, ['options' => ['max_range' => $longitud]])) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

/**
 * Valida si una variable cumple con una expresión regular dada.
 *
 * @param string &$var      Variable a validar por referencia. Si no cumple la expresión, se asigna el valor por defecto.
 * @param string $expresion Expresión regular a utilizar para la validación.
 * @param string $defecto   Valor por defecto a asignar a la variable si no cumple la expresión.
 * @return bool             Devuelve true si la variable cumple la expresión regular, false en caso contrario.
 */
function validaExpresion(string &$var, string $expresion, string $defecto): bool
{
    if (filter_var($var, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $expresion]])) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

/**
 * Valida si una variable existe dentro de un rango de valores o claves posibles.
 *
 * @param mixed $var Variable a validar.
 * @param array $posibles Arreglo de valores o claves posibles.
 * @param int $tipo Tipo de validación:
 *                  - 1: Verifica si $var es igual a algún valor en $posibles.
 *                  - 2: Verifica si $var es igual a alguna clave en $posibles.
 *                  Por defecto es 1.
 * @return bool Retorna true si $var se encuentra según el tipo especificado, false en caso contrario.
 */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool
{
    $sh = false;

    switch ($tipo) {
        case 1:
            foreach ($posibles as $key => $value) {
                if ($var === $value) {
                    $sh = true;
                }
            }
            break;
        case 2:
            foreach ($posibles as $key => $value) {
                if ($var === $key) {
                    $sh = true;
                }
            }
            break;
    }

    return $sh;
}
