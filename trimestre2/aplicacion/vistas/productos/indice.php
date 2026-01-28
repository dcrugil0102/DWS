<?php

$pagi = new CPager($opcPag, array());

$tabla = new CGrid(
    $cabe,
    $filas,
    array("class" => "tabla1")
);

echo $pagi->dibujate();

echo $tabla->dibujate();

echo $pagi->dibujate();
