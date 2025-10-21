<?php
final class Flauta extends InstrumentoViento implements IFabricante
{
    private function __construct($material, $edad)
    {
        parent::__construct($material, $edad);
    }
    static function crearDesdeArray($datos)
    {
        $material = $datos['material'] ?? 'madera';
        $edad = $datos['edad'] ?? 15;

        return new Flauta($material, $edad);
    }
}
