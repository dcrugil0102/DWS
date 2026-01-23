
<?php
echo CHTML::iniciarForm(atributosHTML: ["class" => "form-login"]);
echo CHTML::dibujaEtiqueta("h1", [], "Registro de nuevo usuario");
echo CHTML::dibujaEtiquetaCierre("h1");

// *** CAMPO NICK ** //

echo CHTML::modeloLabel($modelo, "nick",);
echo CHTML::modeloText($modelo, "nick", array("maxlength" => 40, "placeholder" => "Enrique Pastor"));
echo CHTML::modeloError($modelo, "nick");

// *** CAMPO NIF ** //

echo CHTML::modeloLabel($modelo, "nif");
echo CHTML::modeloText(
    $modelo,
    "nif",
    array("maxlength" => 10, "placeholder" => "12345678A")
);
echo CHTML::modeloError($modelo, "nif");

// *** CAMPO FECHA NACIMIENTO ** //

echo CHTML::modeloLabel($modelo, "fecha_nacimiento");
echo CHTML::modeloText(
    $modelo,
    "fecha_nacimiento",
    array("maxlength" => 10,)
);
echo CHTML::modeloError($modelo, "fecha_nacimiento");

// ** CAMPO PROVINCIA ** //

echo CHTML::modeloLabel($modelo, "provincia");
echo CHTML::modeloText(
    $modelo,
    "provincia",
    array("maxlength" => 30, "size" => 31)
);
echo CHTML::modeloError($modelo, "provincia");

// ** CAMPO ESTADO ** //

echo CHTML::modeloLabel($modelo, "estado");
echo CHTML::modeloListaDropDown(
    $modelo,
    "estado",
    DatosRegistro::dameEstados(null),
    array("linea" => false)
);
echo CHTML::modeloError($modelo, "estado");

// ** CAMPO CONTRASEÑA ** //

echo CHTML::modeloLabel($modelo, "contrasenia");
echo CHTML::modeloPassword(
    $modelo,
    "contrasenia",
    array("maxlength" => 30, "size" => 31)
);
echo CHTML::modeloError($modelo, "contrasenia");

// ** CAMPO CONTRASEÑA ** //

echo CHTML::modeloLabel($modelo, "confirmar_contrasenia");
echo CHTML::modeloPassword(
    $modelo,
    "confirmar_contrasenia",
    array("maxlength" => 30, "size" => 31)
);
echo CHTML::modeloError($modelo, "confirmar_contrasenia");



echo CHTML::campoBotonSubmit("Crear");
echo CHTML::finalizarForm();
