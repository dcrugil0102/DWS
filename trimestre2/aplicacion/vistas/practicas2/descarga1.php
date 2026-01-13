<?php

$archivo = "/../../../imagenes/chicotetactico.jpg";

if (file_exists($archivo)) {
    # code...
}
header('Content-Description: File Transfer');
readfile($archivo);
exit;
