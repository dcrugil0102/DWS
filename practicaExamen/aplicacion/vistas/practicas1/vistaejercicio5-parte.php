   <?php

    $tipo = gettype($valore);
    switch ($tipo) {
        case "array":
            foreach ($valore as $clave2 => $valor2) {
                echo $valor2;
                echo "<br>";
            }
            break;
        case "integer":
            echo $valore . " en binario = " . decbin($valore);
            break;
        case "double":
            echo $valore . " que el cuadrado es " . $valore * $valore . "<br>";
            break;
        case "string":
            echo $valore . "<br>";
            break;
        case "boolean":
            echo $valore ? 'True' : "False" . " y su opuesto es " . (!$valore ? "true" : "false") . "<br>";
            break;
    }
    
