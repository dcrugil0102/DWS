<?php 

include_once(dirname(__FILE__) . "/global.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // header("Content-Type: image/jpeg");
    // header("Content-Disposition: attachment; filename=\"puntos.jpeg\"");

    recrearImg($arrayPuntos);

    imagejpeg($img);
    imagedestroy($img);
    exit;
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