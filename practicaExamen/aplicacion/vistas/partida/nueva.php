<?php
echo CHTML::iniciarForm("#", "get", []);
echo CHTML::dibujaEtiqueta("label", ["for" => "cod_baraja"], "Selecciona un codigo de baraja:  ", true);
echo CHTML::dibujaEtiqueta("select", ["name" => "cod_baraja"]);
$lista = new Listas();
$barajas = $lista::listaTiposBarajas(true);
//opcion inventada
echo "<option value='9'>9</option>";
foreach ($barajas as $baraja => $clave) {
    echo "<option value=" . $baraja . ">$baraja</option>";
}
echo CHTML::dibujaEtiquetaCierre("select");
echo CHTML::dibujaEtiqueta("br");
echo CHTML::dibujaEtiqueta("label", ["for" => "fecha"], "Selecciona una fecha:  ", true);
echo CHTML::dibujaEtiqueta("input", ["type" => "text", "placeholder" => "yyyy-mm-dd", "name" => "fecha"]);
echo CHTML::dibujaEtiqueta("br");
echo CHTML::dibujaEtiqueta("label", ["for" => "mesa"], "Selecciona una mesa:  ", true);
echo CHTML::dibujaEtiqueta("input", ["type" => "number", "name" => "mesa"]);
echo CHTML::dibujaEtiqueta("br");
echo CHTML::dibujaEtiqueta("label", ["for" => "crupier"], "Selecciona un crupier:  ", true);
echo CHTML::dibujaEtiqueta("input", ["type" => "text", "name" => "crupier"]);
echo CHTML::dibujaEtiqueta("br");
if ($_GET["cod_baraja"] === 5) {
}
echo CHTML::boton("Enviar", ["type" => "submit"]);
