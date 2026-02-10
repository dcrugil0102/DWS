<?php

echo CHTML::dibujaEtiqueta("div");

echo CHTML::dibujaEtiqueta("h3", [], $pueblo->nombre);
echo CHTML::dibujaEtiquetaCierre("h3");

echo CHTML::dibujaEtiqueta("p", [], "Tipo: " . $pueblo->descripcion_tipo);
echo CHTML::dibujaEtiquetaCierre("p");

echo CHTML::dibujaEtiqueta("p", [], "Elemento: " . $pueblo->elemento);
echo CHTML::dibujaEtiquetaCierre("p");

echo CHTML::dibujaEtiqueta("p", [], "Reconocido por la UNESCO: " . ($pueblo->reconocido_unesco == 1 ? "Si" : "No"));
echo CHTML::dibujaEtiquetaCierre("p");

echo CHTML::dibujaEtiqueta("p", [], "Fecha de reconocimiento: " . $pueblo->fecha_reconocimiento);
echo CHTML::dibujaEtiquetaCierre("p");

echo CHTML::dibujaEtiquetaCierre("div");