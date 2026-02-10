<?php

echo CHTML::dibujaEtiqueta("h2", [], "Nuevo pueblo");
echo CHTML::dibujaEtiquetaCierre("h1");

echo CHTML::iniciarForm(atributosHTML: ["class" => "form-login"]);

// *** CAMPO NOMBRE ** //

echo CHTML::modeloLabel($modelo, "nombre",);
echo CHTML::modeloText($modelo, "nombre", array("maxlength" => 30, "placeholder" => "Fuentealbilla"));
echo CHTML::modeloError($modelo, "nombre");

// *** CAMPO COD_TIPO_ELEMENTO ** //

echo CHTML::modeloLabel($modelo, "cod_tipo_elemento");
echo CHTML::modeloListaDropDown(
    $modelo,
    "cod_tipo_elemento",
    Listas::listaTiposElemento(null, false),
    array("linea" => "Sin indicar")
);
echo CHTML::modeloError($modelo, "cod_tipo_elemento");

// *** CAMPO ELEMENTO ** //

echo CHTML::modeloLabel($modelo, "elemento");
echo CHTML::modeloText(
    $modelo,
    "elemento",
    array("maxlenght" => 35)
);
echo CHTML::modeloError($modelo, "elemento");

// ** CAMPO RECONOCIDO_UNESCO ** //

echo CHTML::dibujaEtiqueta("div");
echo CHTML::modeloLabel($modelo, "reconocido_unesco");
echo CHTML::modeloRadioButton(
    $modelo,
    "reconocido_unesco",
    
);
echo CHTML::modeloError($modelo, "reconocido_unesco");
echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiqueta("br");

// ** CAMPO FECHA_RECONOCIMIENTO ** //

echo CHTML::modeloLabel($modelo, "fecha_reconocimiento");
echo CHTML::modeloText(
    $modelo,
    "fecha_reconocimiento",
    array("maxlength" => 10, "placeholder" => "12345678A")
);
echo CHTML::modeloError($modelo, "fecha_reconocimiento");

echo CHTML::campoBotonSubmit("Crear");

echo CHTML::finalizarForm();