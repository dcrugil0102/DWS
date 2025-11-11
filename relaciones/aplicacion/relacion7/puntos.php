<?php

$arrayPuntos = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($errores)) {
       try {
        $arrayPuntos[] = new Punto($valores['cordX'], $valores['cordY'], $valores['color'], $valores['grosor']);
    } catch (Exception $err) {
        $errores['error'] = $err->getMessage();
    }
    }
}
?>