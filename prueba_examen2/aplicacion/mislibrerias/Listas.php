<?php

class Listas
{
    static public function listaTiposBarajas(bool $completo = false, ?int $cod_baraja = null)
    {
        $barajas = [
            5 => ["nombre" => "española normal", "min_juga" => 2, "max_juga" => 4],
            6 => ["nombre" => "pocker", "min_juga" => 4, "max_juga" => 4],
            7 => ["nombre" => "figuras", "min_juga" => 4, "max_juga" => 8]
        ];

        // Si se pasa código de baraja
        if ($cod_baraja !== null) {
            if (!isset($barajas[$cod_baraja])) {
                return false;
            }
            return $completo ? $barajas[$cod_baraja] : $barajas[$cod_baraja]["nombre"];
        }

        // Si NO se pasa código
        $resultado = [];
        foreach ($barajas as $codigo => $datos) {
            $resultado[$codigo] = $completo ? $datos : $datos["nombre"];
        }

        return $resultado;
    }
}
