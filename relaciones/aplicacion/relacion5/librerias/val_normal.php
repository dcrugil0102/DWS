<?php

function validaEntero(int &$var, int $min, int $max, int $defecto): bool
{
    if (is_int($var) && $var >= $min && $var <= $max) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

function validaReal(float &$var, float $min, float $max, float $defecto): bool
{
    if (is_numeric($var) && $var >= $min && $var <= $max) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

function validaFecha(string &$var, string $defecto): bool
{
    $formato = "d/m/Y";
    $valida = DateTime::createFromFormat($formato, $var);

    if ($valida && $valida->format($formato) === $var) {
        $var = $valida->format($formato);
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

function validaHora(string &$var, string $defecto): bool
{
    $formato = "H:i:s";
    $valida = DateTime::createFromFormat($formato, $var);

    if ($valida && $valida->format($formato) === $var) {
        $var = $valida->format($formato);
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

function validaEmail(string &$var, string $defecto): bool
{
    $patron = "/^[\w.-]+@[\w.-]\.[a-zA-Z]{2,}$/";

    if (preg_match($patron, $var))
        return true;
    else {
        $var = $defecto;
        return false;
    }
}

function validaCadena(string &$var, int $longitud, string $defecto): bool
{
    if (strlen($var) > $longitud) {
        $var = $defecto;
        return false;
    } else
        return true;
}

function validaExpresion(string &$var, string $expresion, string $defecto): bool
{
    if (preg_match($expresion, $var)) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

function validaRango(mixed $var, array $posibles, int $tipo = 1): bool
{
    $sh = false;

    switch ($tipo) {
        case 1:
            foreach ($posibles as $key => $value) {
                $sh = $var == $value;
            }
            break;
        case 2:
            foreach ($posibles as $key => $value) {
                $sh = $var == $key;
            }
            break;
    }

    return $sh;
}
