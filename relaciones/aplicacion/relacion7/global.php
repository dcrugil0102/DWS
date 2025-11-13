<?php 
$arrayPuntos = [];
$rutaPunto = __DIR__ . "/" . $nombrePunto;

if (file_exists($rutaPunto) && !empty($rutaPunto)) {
    $fic = fopen($rutaPunto, "r");
    while(($linea = fgets($fic)) !== false){
        $datos = explode(';', trim($linea));
            
            foreach (Punto::GROSORES as $key => $value) {
                if ($datos[3] == $value) {
                    $datos[3] = $key;
                }
            }

            try {
                $arrayPuntos[] = new Punto($datos[0],$datos[1], $datos[2], $datos[3]);
            } catch (Exception $err) {
            $errores[] = $err;
            }
    }
}
?>