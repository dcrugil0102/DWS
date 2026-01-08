<?php

include_once(dirname(__FILE__) . "/global.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: image/jpeg");
    header("Content-Disposition: attachment; filename=\"puntos.jpeg\"");

    $img = recrearImg($arrayPuntos);

    imagejpeg($img);
    imagedestroy($img);
    exit;
}
