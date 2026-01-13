<h1>Ejercicio 5:</h1>

<?php
    foreach ($vector as $posicion => $contenido) {
        echo "- posicion $posicion contenido (tipo) ";

        if (is_array($contenido)) {
            echo "array:<br>";
            foreach ($contenido as $valor) {
                echo "--- $valor<br>";
            }
        } elseif (is_int($contenido)) {
            $binario = decbin($contenido);
            echo "entero bonito valor $contenido en binario $binario<br>";
        } elseif (is_float($contenido)) {
            $cuadrado = $contenido * $contenido;
            echo "$contenido que al cuadrado es $cuadrado<br>";
        } elseif (is_string($contenido)) {
            echo "-$contenido-<br>";
        } elseif (is_bool($contenido)) {
            $texto = $contenido ? "true" : "false";
            $opuesto = !$contenido ? "true" : "false";
            echo "$texto y su opuesto $opuesto<br>";
        }
    }