<?php

$archivo = __DIR__ . "/../../../imagenes/alberto-chicote-instagram.jpeg";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (file_exists($archivo)) {
        header("Content-Type: image/jpeg");
        header('Content-Disposition: attachment; filename="' . basename($archivo) . '"');
        readfile($archivo);
        exit;
    }
}


echo CHTML::iniciarForm("descarga1", "post");

echo CHTML::botonHtml("Descargar Imagen", ["type" => "submit"]);

echo CHTML::finalizarForm();
