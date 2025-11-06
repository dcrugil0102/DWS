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
    public function setNombre(string $nombre): bool
    {
        if(!validaCadena($nombre, 40, $nombre) || $nombre == ""){
            return false;
        } else{
            $this->nombre = mb_strtoupper($nombre);
            return true;
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
    public function setFabricante(string $fabricante): bool
    {
        if (validaCadena($fabricante, 30, "FMu: ") && $fabricante != "") {
            $original = $fabricante;
            if (validaExpresion($fabricante, "/^FMu:/", "FMu: ")) {
                $this->fabricante = $fabricante;
            } else{
                $this->fabricante = "FMu: " . $original;
            }
            return true;
        } else return false;
        
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
    public function setPais(string $pais): bool
    {
        if(validaCadena($pais, 20, "ESPAÑA")){
            $this->pais = $pais;
            return true;
        } else return false;
        
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
    public function setAnio(int $anio): bool
    {
        $anioActual = (new DateTime())->format("yyyy");

        if (validaEntero($anio, 2020, $anioActual, 2020)) {
            $this->anio = $anio;
            return true;
        } else
            return false;
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
    public function setFechaIniVenta(string $fechaIniVenta): bool
    {
        if (validaFecha($fechaIniVenta, '01/01/2020')) {

        $anioFab = new DateTime("01/01/".$this->getAnio());
        $fechaIniVenta = DateTime::createFromFormat('d/m/Y', $fechaIniVenta);

            if ($fechaIniVenta >= $anioFab) {
                $this->fechaIniVenta = $fechaIniVenta;
                return true;
            } else
                return false;
        } else
            return false;
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
    public function setFechaFinVenta(string $fechaFinVenta): bool
    {
        if (validaFecha($fechaFinVenta, "31/12/2040")) {
            $fechaIni = new DateTime($this->getFechaIniVenta());
            $fechaFinVenta2 = new DateTime($fechaFinVenta);

            if ($fechaFinVenta2 > $fechaIni) {
                $this->fechaFinVenta = $fechaFinVenta;
                return true;
            } else
                return false;
        } else return false;
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
    public function setMaterialPrincipal(int $MaterialPrincipal): bool
    {
        if (validaRango($MaterialPrincipal, self::MATERIALES_POSIBLES, 2)) {
            $this->MaterialPrincipal = $MaterialPrincipal;
            return true;
        } else
            return false;
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
    public function setPrecio(float $Precio): bool
    {
        if(validaReal($Precio, 30, 999999,30)){
            $this->Precio = $Precio;
            return true;
        } else
            return false;
    }

    public function getMaterialDescripcion(): string{
        
    }
}
