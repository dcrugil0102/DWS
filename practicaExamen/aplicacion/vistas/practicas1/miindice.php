<?php
$ejercicios = [
    "ejercicio1" => "Ejercicio 1",
    "ejercicio2" => "Ejercicio 2",
    "ejercicio3" => "Ejercicio 3",
    "ejercicio5" => "Ejercicio 5",
    "ejercicio7" => "Ejercicio 7"
];
echo CHTML::dibujaEtiqueta(
    "ul",
    [
        "id" => "ejercicios"
    ],
    "",
    false
);
foreach ($ejercicios as $ejercicio => $nombre) {
    echo CHTML::dibujaEtiqueta(
        "li",
        array(),
        "",
        false
    );
    echo CHTML::css("padding", "40px");
    echo CHTML::link($nombre, Sistema::app()->generaURL(["practicas1", $ejercicio]));
    echo CHTML::dibujaEtiquetaCierre("li");
}
echo CHTML::dibujaEtiquetaCierre("ul");
