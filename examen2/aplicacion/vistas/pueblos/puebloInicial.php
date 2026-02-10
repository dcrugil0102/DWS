<?php

echo CHTML::link(CHTML::imagen("/imagenes/16x16/nuevo.png") . " NUEVO", Sistema::app()->generaURL(["pueblos", "nuevo"]));

echo CHTML::dibujaEtiqueta("br");
echo CHTML::dibujaEtiqueta("br");

echo CHTML::iniciarForm(metodo: "get");

echo CHTML::campoRadioButton("unesco", false, ["value" => 1, "id" => "con"]);
echo CHTML::campoLabel("Con UNESCO", "con");

echo CHTML::dibujaEtiqueta("br");

echo CHTML::campoRadioButton("unesco", false, ["value" => 0, "id" => "sin"]);
echo CHTML::campoLabel("Sin UNESCO", "sin");

echo CHTML::dibujaEtiqueta("br");
echo CHTML::dibujaEtiqueta("br");

echo CHTML::campoBotonSubmit("Ver");

echo CHTML::finalizarForm();
