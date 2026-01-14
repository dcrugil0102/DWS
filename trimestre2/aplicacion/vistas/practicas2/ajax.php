<?php

echo CHTML::scriptFichero("/js/peticionAjax.js", ["defer" => "true"]);

echo CHTML::iniciarForm(Sistema::app()->generaURL(["practicas2", "pedirDatos"]), "get");

echo CHTML::campoLabel("Introduce el min: ", "min");
echo CHTML::campoText("min", "", ["id" => "min"]);

echo CHTML::dibujaEtiqueta("br");
echo CHTML::dibujaEtiqueta("br");

echo CHTML::campoLabel("Introduce el max: ", "max");
echo CHTML::campoText("max", "", ["id" => "max"]);

echo CHTML::dibujaEtiqueta("br");
echo CHTML::dibujaEtiqueta("br");

echo CHTML::campoLabel("Introduce el patron: ", "patron");
echo CHTML::campoText("patron", "", ["id" => "patron"]);

echo CHTML::dibujaEtiqueta("br");
echo CHTML::dibujaEtiqueta("br");

echo chtml::boton("Pedir", ["type" => "submit", "onclick" => "hacerPeticion() "]);

echo CHTML::finalizarForm();

echo CHTML::dibujaEtiqueta("div", ["id" => "resultado"]);
echo CHTML::dibujaEtiquetaCierre("div");