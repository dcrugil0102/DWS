<?php

class Listas
{
    static public function listaTiposElemento(?int $cod_tipo = null, bool $soloCodigo = false)
    {
        $tipos = [
            1 => "Monumento",
            2 => "Gastronomico",
            3 => "Sitio de interes",
            4 => "Costumbre"
        ];

        if ($soloCodigo) {
            return array_keys($tipos);
        } else{
            if ($cod_tipo === null) {
                return $tipos;
            } else{
                return isset($tipos[$cod_tipo]);
            }
        }
    }
}
