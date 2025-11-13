<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: image/jpeg");
    recrearImg($nombreImg, $arrayPuntos);
}
?>