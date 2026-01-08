<?php 
include_once(dirname(__FILE__) . "/../../scripts/class/Punto.php");

$arrayPuntos = [];

$nombrePunto = "puntos/puntos_";

// Sacar IP y navegador del cliente

$ip = getenv("REMOTE_ADDR");
$navegador = "otro";

$navegadores = [
    '/chrome/i' => 'chrome',
    '/firefox/i' => 'firefox',
    '/safari/i' => 'safari',
    '/edge/i' => 'edge',
    '/opera/i' => 'opera'
];

foreach ($navegadores as $patron => $value) {
    if (preg_match($patron, $_SERVER['HTTP_USER_AGENT'])) {
        $navegador = $value;
        break;
    }
}

// Crear fichero de los puntos

foreach (explode(".", $ip) as $n) $nombrePunto .= $n . "_";
$nombrePunto .= "$navegador.dat";

$rutaPunto = __DIR__ . "/" . $nombrePunto;

// Crear imagen

$nombreImg = "../../img/puntos/";

foreach (explode(".", $ip) as $n) {
    $nombreImg .= $n . "_";
}

$nombreImg .= $navegador . ".jpeg";

if (!file_exists($nombreImg)) {
    $img = crearImg();
    
    imagejpeg($img, $nombreImg, 100);
    imagedestroy($img);
}

// Cargar Puntos en el array

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




function crearImg(){
    $img = imagecreatetruecolor(500, 500);

    $blanco = imagecolorallocate($img, 255, 255, 255);
    $negro = imagecolorallocate($img, 0, 0, 0);

    imagefilledrectangle($img, 0, 0, 500, 500, $blanco);
    imagerectangle($img, 0, 0, 499, 499, $negro);

    return $img;
}

function recrearImg($arrayPuntos){
    $img = crearImg();

    foreach ($arrayPuntos as $punto) {
        $colorPunto = $punto::COLORES[$punto->getColor()]['rgb'];
        $colorImg = imagecolorallocate($img, $colorPunto[0], $colorPunto[1], $colorPunto[2]);

        $grosor = $punto->getGrosor();

        imagefilledellipse($img, $punto->getX(), $punto->getY(), $grosor*5, $grosor*5, $colorImg);
    }

    return $img;
}
?>