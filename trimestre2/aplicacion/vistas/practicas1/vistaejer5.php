<h1>Ejercicio 5:</h1>

<?php
    foreach ($vector as $posicion => $contenido) {
        $this->dibujaVistaParcial("vistaejer5-parte", ["contenido" => $contenido, "posicion" => $posicion]);
    }

    