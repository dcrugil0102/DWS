<?php

$this->textoHead=CPager::requisitos();

$pagi = new CPager($opcPag, array());

$tabla = new CGrid(
    $cabe,
    $filas,
    array("class" => "tabla1")
);

echo CHTML::dibujaEtiqueta("h2",[],"Filtrar por:");

echo CHTML::iniciarForm(["productos","index"]);

echo CHTML::campoLabel("Nombre: ","nombre");
echo CHTML::campoText("nombre");

echo CHTML::dibujaEtiqueta("br");

echo CHTML::campoLabel("Categoría: ","categoria");
echo CHTML::campoText("categoria");

echo CHTML::dibujaEtiqueta("br");

echo CHTML::campoLabel("Borrado: ","borrado");
echo CHTML::campoCheckBox("borrado",false,["value"=>"si"]);

echo CHTML::dibujaEtiqueta("br");

echo CHTML::campoBotonSubmit("Buscar",["name"=>"filtrar"]);
echo CHTML::campoBotonSubmit("Descargar",["name"=>"descargar"]);
echo CHTML::finalizarForm();

echo $pagi->dibujate();

echo $tabla->dibujate();

echo $pagi->dibujate();
