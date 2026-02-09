<?php
echo "<br>";
echo "Codigo de Partida: " . $partida->cod_partida . "<br>";
echo "Numero de Mesa: " . $partida->mesa . "<br>";
echo "Fecha de la Partida: " . $partida->fecha . "<br>";
echo "Codigo de Baraja: " . $partida->cod_baraja . "<br>";
echo "Numero de Jugadores: " . $partida->jugadores . "<br>";
echo "Crupier de la Partida: " . $partida->crupier . "<br>";

echo CHTML::dibujaEtiqueta("a", ["href" => Sistema::app()->generaURL(["partida", "descargar"], ["cod" => $partida->cod_partida])], "Descargar Partida", true);
