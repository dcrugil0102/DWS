<?php
    echo "<br/>";

    echo "Hola mundo.";
    echo "<br/>";
    echo "<br/>".PHP_EOL;

    echo "funciona que no es poco";
    Sistema::app()->generaURL(["usuarios", "borrar"], ["id" => 12, "nombre" => "pepe"]);
    
