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

        // Si se pasa código de tipo
        if ($cod_tipo !== null) {
            if (!isset($tipos[$cod_tipo])) {
                return false;
            }
            return $soloCodigo ? $tipos[$cod_tipo] : $tipos[$cod_tipo]["nombre"];
        }

        // Si no se pasa código
        $resultado = [];
        foreach ($tipos as $codigo => $datos) {
            $resultado[$codigo] = $soloCodigo ? $datos : $datos["nombre"];
        }

        return $resultado;
    }
}
