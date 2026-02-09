<?php

$enlaces = [
    "mierror" => "Error",
    "descarga1" => "Descarga 1",
    "descarga2" => "Descarga 2",
    "pedirDatos/min=1&max=10&patron=macarron" => "Pedir Datos",
    "peticionajax" => "Peticion Ajax"
];
echo CHTML::dibujaEtiqueta(
    "ul",
    [
        "id" => "ejercicios"
    ],
    "",
    false
);
foreach ($enlaces as $enlace => $nombre) {
    echo CHTML::dibujaEtiqueta(
        "li",
        array(),
        "",
        false
    );
    echo CHTML::css("padding", "40px");
    echo CHTML::link($nombre, Sistema::app()->generaURL(["practicas2", $enlace]));
    echo CHTML::dibujaEtiquetaCierre("li");
}
echo CHTML::dibujaEtiquetaCierre("ul");
