<?php

class MuebleReciclado extends MuebleBase
{
    // PROPIEDADES **********************

    public int $PorcentajeReciclado = 10;

    // CONSTRUCTOR **********************

    public function __construct(string $nombre, ?string $fabricante = 'FMu', ?string $pais = 'ESPAÑA', ?int $anio = 2020, ?string $fechaIniVenta = '01/01/2020', ?string $fechaFinVenta = '31/12/2040', ?int $MaterialPrincipal, ?float $Precio = 30, int $PorcentajeReciclado){
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $MaterialPrincipal, $Precio);
        if (!$this->setPorcentajeReciclado($PorcentajeReciclado)) {
            throw new Exception("Error al asignar el porcentaje reciclado");
        }
    }

    // GETTERS Y SETTERS ****************

    public function getPorcentajeReciclado(): int
    {
        return $this->PorcentajeReciclado;
    }
    public function setPorcentajeReciclado(int $PorcentajeReciclado): bool
    {
        if (validaEntero($PorcentajeReciclado, 0, 100, 10)) {
            $this->PorcentajeReciclado = $PorcentajeReciclado;
            return true;
        } else {
            return false;
        }
    }
}
