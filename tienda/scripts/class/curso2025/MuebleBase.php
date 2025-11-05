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
    public string $fabricante = "FMu";
    public string $pais = "ESPAÑA";
    public int $anio = 2020;
    public string $fechaIniVenta = "01/01/2020";
    public string $fechaFinVenta = "31/12/2040";
    public int $MaterialPrincipal;
    public float $Precio = 30;


    // GETTERS Y SETTERS *********************

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        if(!validaCadena($nombre, 40, $nombre) || $nombre == ""){
            throw new Exception("El nombre tiene que tener entre 1 y 40 carácteres");
        } else{
            $this->nombre = mb_strtoupper($nombre);
        }
    }

    /**
     * @return string
     */
    public function getFabricante(): string
    {
        return $this->fabricante;
    }

    /**
     * @param string $fabricante
     */
    public function setFabricante(string $fabricante): void
    {
        $this->fabricante = $fabricante;
    }

    /**
     * @return string
     */
    public function getPais(): string
    {
        return $this->pais;
    }

    /**
     * @param string $pais
     */
    public function setPais(string $pais): void
    {
        $this->pais = $pais;
    }

    /**
     * @return int
     */
    public function getAnio(): int
    {
        return $this->anio;
    }

    /**
     * @param int $anio
     */
    public function setAnio(int $anio): void
    {
        $this->anio = $anio;
    }

    /**
     * @return string
     */
    public function getFechaIniVenta(): string
    {
        return $this->fechaIniVenta;
    }

    /**
     * @param string $fechaIniVenta
     */
    public function setFechaIniVenta(string $fechaIniVenta): void
    {
        $this->fechaIniVenta = $fechaIniVenta;
    }

    /**
     * @return string
     */
    public function getFechaFinVenta(): string
    {
        return $this->fechaFinVenta;
    }

    /**
     * @param string $fechaFinVenta
     */
    public function setFechaFinVenta(string $fechaFinVenta): void
    {
        $this->fechaFinVenta = $fechaFinVenta;
    }

    /**
     * @return int
     */
    public function getMaterialPrincipal(): int
    {
        return $this->MaterialPrincipal;
    }

    /**
     * @param int $MaterialPrincipal
     */
    public function setMaterialPrincipal(int $MaterialPrincipal): void
    {
        $this->MaterialPrincipal = $MaterialPrincipal;
    }

    /**
     * @return float
     */
    public function getPrecio(): float
    {
        return $this->Precio;
    }

    /**
     * @param float $Precio
     */
    public function setPrecio(float $Precio): void
    {
        $this->Precio = $Precio;
    }
}
