<?php

final class MuebleReciclado extends MuebleBase
{
    // PROPIEDADES **********************

    public int $PorcentajeReciclado = 10;

    // CONSTRUCTOR **********************

    public function __construct(
        string $nombre,
        int $MaterialPrincipal,
        int $PorcentajeReciclado,
        ?string $fabricante = 'FMu',
        ?string $pais = 'ESPAÑA',
        ?int $anio = 2020,
        ?string $fechaIniVenta = '01/01/2020',
        ?string $fechaFinVenta = '31/12/2040',
        ?float $Precio = 30
    ) {
        parent::__construct($nombre, $MaterialPrincipal, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $Precio);

        if (!$this->setPorcentajeReciclado($PorcentajeReciclado)) {
            throw new Exception("Error al asignar el porcentaje reciclado");
        }
    }


    // METODOS **************************

    public function dameListaPropiedades()
    {
        $lista = array_merge(parent::dameListaPropiedades(), ["peso" => $this->getPorcentajeReciclado()]);
        return $lista;
    }

    public function __toString()
    {
        $cadena = parent::__toString();
        $cadena .= "Porcentaje reciclado: {$this->getPorcentajeReciclado()}%\n";
        return $cadena;
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
