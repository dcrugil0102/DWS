<?php
class Listas
{
    public static function listaTiposBarajas(bool $completo = false,  ?int $cod_baraja = null)
    {
        $barajas = [
            5 => ["nombre" => "española normal", "min_juga" => 2, "max_juga" => 4],
            6 => ["nombre" => "pocker", "min_juga" => 4, "max_juga" => 4],
            7 => ["nombre" => "figuras", "min_juga" => 4, "max_juga" => 8]
        ];
        $resultado = [];
        if ($cod_baraja !== null && isset($barajas[$cod_baraja])) {
            if ($completo === true) {
                $resultado = $barajas[$cod_baraja];
            } else {
                $resultado = $barajas[$cod_baraja]["nombre"];
            }
        } else {
            if ($completo === true) {
                $resultado = $barajas;
            } else {
                foreach ($barajas as $baraja => $valor) {
                    $resultado[$baraja] = $valor["nombre"];
                }
            }
        }
        return $resultado;
    }
}
