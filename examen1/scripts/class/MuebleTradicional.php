<?php

final class MuebleTradicional extends MuebleBase
{
    // PROPIEDADES **********************

    public float $peso = 15;
    public string $serie = "S01";

    // CONSTRUCTOR **********************

    public function __construct(string $nombre, ?int $MaterialPrincipal, ?float $Precio = 30, float $peso = 15, string $serie = "S01", ?string $fabricante = 'FMu', ?string $pais = 'ESPAÑA', ?int $anio = 2020, ?string $fechaIniVenta = '01/01/2020', ?string $fechaFinVenta = '31/12/2040')
    {
        parent::__construct($nombre, $MaterialPrincipal, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $Precio);

        if (!$this->setPeso($peso)) {
            throw new Exception("Error al asignar el peso");
        }
        if (!$this->setSerie($serie)) {
            throw new Exception("Error al asignar la serie");
        }
    }

    // METODOS **************************

    public function dameListaPropiedades()
    {
        $lista = array_merge(parent::dameListaPropiedades(), ["peso" => $this->getPeso(), "serie" => $this->getSerie()]);
        return $lista;
    }

    public function __toString()
    {
        $cadena = parent::__toString();
        $cadena .= "Peso: {$this->getPeso()} kg\nSerie: {$this->getSerie()}\n";
        return $cadena;
    }


    // GETTERS Y SETTERS ****************

    public function getPeso(): float
    {
        return $this->peso;
    }
    public function setPeso(float $peso): bool
    {
        if (validaReal($peso, 15, 300, 15)) {
            $this->peso = $peso;
            return true;
        } else {
            return false;
        }
    }



    /**
     * @return string
     */
    public function getSerie(): string
    {
        return $this->serie;
    }

    /**
     * @param string $serie
     */
    public function setSerie(string $serie): bool
    {
        $this->serie = $serie;
        return true;
    }
}
