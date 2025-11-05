<?php

abstract class MuebleBase
{
    // VARIABLES ***********************

    public const MATERIALES_POSIBLES = [
    1 => 'madera', 
    2 => 'metal',
    3 => 'plástico',
    4 => 'vidrio',
    5 => 'cerámica'];

    public const MAXIMO_MUEBLES = 5;

    private static $_mueblesCreados = 0;
    public $id = 0;

    public string $nombre;
    public string $fabricante;
    public string $pais;
    public int $anio;
    public string $fechaIniVenta;
    public string $fechaFinVenta;
    public int $MaterialPrincipal;
    public float $Precio;

}
