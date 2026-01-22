<H1>Registro de nuevo usuario</H1>
<br />
<?php
echo CHTML::iniciarForm();
echo CHTML::modeloLabel($modelo, "nick");
echo CHTML::modeloText($modelo, "nick", array("maxlength" => 40, "size" => 30));
echo CHTML::modeloError($modelo, "nick");
echo "<br>";
echo "<br>";
echo CHTML::modeloLabel($modelo, "nif");
echo CHTML::modeloText(
    $modelo,
    "nif",
    array("maxlength" => 10, "size" => 10)
);
echo CHTML::modeloError($modelo, "nif");
echo "<br>";
echo "<br>";
echo CHTML::modeloLabel($modelo, "fecha_alta");
echo CHTML::modeloText(
    $modelo,
    "fecha_alta",
    array("maxlength" => 10, "size" => 11)
);
echo CHTML::modeloError($modelo, "fecha_alta");
echo "<br>";
echo "<br>";
echo CHTML::modeloLabel($modelo, "cod_fabricante");
echo CHTML::modeloListaDropDown(
    $modelo,
    "cod_fabricante",
    DatosRegistro::dameEstados(null),
    array("linea" => false)
);
echo CHTML::modeloError($modelo, "cod_fabricante");
echo "<br>";

echo "<br>";
echo CHTML::campoBotonSubmit("Crear");
echo CHTML::finalizarForm();
