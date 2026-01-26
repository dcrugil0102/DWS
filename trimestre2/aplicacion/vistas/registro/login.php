
<?php
echo CHTML::iniciarForm(atributosHTML: ["class" => "form-login"]);
echo CHTML::dibujaEtiqueta("h1", [], "Inicio de sesión");
echo CHTML::dibujaEtiquetaCierre("h1");

// *** CAMPO NICK ** //

echo CHTML::modeloLabel($modelo, "nick",);
echo CHTML::modeloText($modelo, "nick", array("maxlength" => 20));
echo CHTML::modeloError($modelo, "nick");

// ** CAMPO CONTRASEÑA ** //

echo CHTML::modeloLabel($modelo, "contrasenia");
echo CHTML::modeloPassword(
    $modelo,
    "contrasenia",
    array("maxlength" => 30, "size" => 31)
);
echo CHTML::modeloError($modelo, "contrasenia");

echo CHTML::campoBotonSubmit("Crear");
echo CHTML::finalizarForm();
