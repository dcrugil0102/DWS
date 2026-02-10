<?php

echo CHTML::dibujaEtiqueta("h1", [], "Nuevo pueblo");
echo CHTML::dibujaEtiquetaCierre("h1");

echo CHTML::iniciarForm();

// *** CAMPO NOMBRE ** //

echo CHTML::modeloLabel($modelo, "nombre",);
echo CHTML::modeloText($modelo, "nombre", array("maxlength" => 30, "placeholder" => "Fuentealbilla"));
echo CHTML::modeloError($modelo, "nombre");

// *** CAMPO COD_TIPO_ELEMENTO ** //

echo CHTML::modeloLabel($modelo, "estado");
echo CHTML::modeloListaDropDown(
    $modelo,
    "estado",
    DatosRegistro::dameEstados(null),
    array("linea" => false)
);
echo CHTML::modeloError($modelo, "estado");

// *** CAMPO ELEMENTO ** //

echo CHTML::modeloLabel($modelo, "fecha_nacimiento");
echo CHTML::modeloText(
    $modelo,
    "fecha_nacimiento",
    array("maxlength" => 10,)
);
echo CHTML::modeloError($modelo, "fecha_nacimiento");

// ** CAMPO RECONOCIDO_UNESCO ** //

echo CHTML::modeloLabel($modelo, "provincia");
echo CHTML::modeloText(
    $modelo,
    "provincia",
    array("maxlength" => 30, "size" => 31)
);
echo CHTML::modeloError($modelo, "provincia");

// ** CAMPO FECHA_RECONOCIMIENTO ** //

echo CHTML::modeloLabel($modelo, "nif");
echo CHTML::modeloText(
    $modelo,
    "nif",
    array("maxlength" => 10, "placeholder" => "12345678A")
);
echo CHTML::modeloError($modelo, "nif");

echo CHTML::campoBotonSubmit("Crear");

echo CHTML::finalizarForm();