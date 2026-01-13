<?php

$archivo = __DIR__ . "/../../../imagenes/chicotetactico.jpg";

if ($_SERVER['REQUEST_METHOD']  == "POST") {
    if (file_exists($archivo)) {
        header('Content-Type: image/jpeg');
        header('Content-Disposition: attachment; filename="'.basename($archivo).'"');

        readfile($archivo);
        exit;
    } 
}


echo CHTML::iniciarForm("descarga1");

echo CHTML::boton("DESCARGAR CHICOTE", ["type" => "submit"]);

echo CHTML::finalizarForm();



