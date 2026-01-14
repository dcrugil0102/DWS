<?php

echo CHTML::link("error", Sistema::app()->generaURL(["practicas2", "mierror"]));
echo CHTML::dibujaEtiqueta("br");
echo CHTML::link("Descarga1", Sistema::app()->generaURL(["practicas2", "descarga1"]));
echo CHTML::dibujaEtiqueta("br");
echo CHTML::link("Descarga2", Sistema::app()->generaURL(["practicas2", "descarga2"]));
echo CHTML::dibujaEtiqueta("br");
echo CHTML::link("Pedir Datos", Sistema::app()->generaURL(["practicas2", "pedirDatos?min=1&max=10&patron=holamundo"]));
echo CHTML::dibujaEtiqueta("br");
echo CHTML::link("Petición Ajax", Sistema::app()->generaURL(["practicas2", "peticionAjax"]));