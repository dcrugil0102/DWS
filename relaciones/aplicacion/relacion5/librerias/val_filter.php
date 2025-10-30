<?php

use BcMath\Number;

function VALFILTER_validaEntero(int &$var, int $min, int $max, int $defecto): bool
{
    $var = (int)filter_var($var, FILTER_SANITIZE_NUMBER_INT);

    if (filter_var($var, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, 'max_range' => $max]]) !== false) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

function VALFILTER_validaReal(float &$var, float $min, float $max, float $defecto): bool
{
    $var = (float)filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    if (filter_var($var, FILTER_VALIDATE_FLOAT) !== false && $var >= $min && $var <= $max) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}

function VALFILTER_validaFecha(string &$var, string $defecto): bool
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

function VALFILTER_validaHora(string &$var, string $defecto): bool
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
