<h1>Ejercicio 3:</h1>

<?php

    echo "<h3>Array 1:</h3>";

    foreach ($datos[0] as $indice => $valor) {
        if (is_array($valor)) {
            foreach ($valor as $indice2 => $valor2) {
                echo "<p>array1[$indice][$indice2] = $valor2</p>";
            }
        } else
            echo "<p>array1[$indice] = $valor</p>";
    }

    echo "<h3>Array 2:</h3>";

    foreach ($datos[1] as $indice => $valor) {
        if (is_array($valor)) {
            foreach ($valor as $indice2 => $valor2) {
                echo "<p>array2[$indice][$indice2] = $valor2</p>";
            }
        } else
            echo "<p>array2[$indice] = $valor</p>";
    }

    echo "<h3>Array 3:</h3>";

    foreach ($datos[2] as $indice => $valor) {
        if (is_array($valor)) {
            foreach ($valor as $indice2 => $valor2) {
                echo "<p>array3[$indice][$indice2] = $valor2</p>";
            }
        } else
            echo "<p>array3[$indice] = $valor</p>";
    }

    echo "<br>";
    echo CHTML::link("Volver", Sistema::app()->generaURL(["practicas1", "miindice"]));