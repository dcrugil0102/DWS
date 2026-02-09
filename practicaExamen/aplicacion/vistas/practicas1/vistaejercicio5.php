<?php
echo "Ejercicio 5";
echo "<br>";
echo "<br>";

foreach ($valore as $clave => $valor) {

    $this->dibujaVistaParcial(
        "vistaejercicio5-parte",
        ["valore" => $valor],
        false
    );
    echo "<br>";
}
echo "<br>";
echo CHTML::link("volver", Sistema::app()->generaURL(["practicas1", "miindice"]));
