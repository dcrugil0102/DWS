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

function VALFILTER_validaReal(float &$var, float $min, float $max, float $defecto):bool{
        $var = (float)filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT);

    if (filter_var($var, FILTER_VALIDATE_FLOAT, ['options' => ['min_range' => $min, 'max_range' => $max]]) !== false) {
        return true;
    } else {
        $var = $defecto;
        return false;
    }
}
