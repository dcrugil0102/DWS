<?php

abstract class MuebleBase
{
    // PROPIEDADES ***********************

    public const MATERIALES_POSIBLES = [
        1 => 'madera',
        2 => 'metal',
        3 => 'plástico',
        4 => 'vidrio',
        5 => 'cerámica'
    ];

    public const MAXIMO_MUEBLES = 20;
    protected static int $_mueblesCreados = 0;
    private string $nombre;
    private string $fabricante = "FMu";
    private string $pais = "ESPAÑA";
    private int $anio = 2020;
    private string $fechaIniVenta = "01/01/2020";
    private string $fechaFinVenta = "31/12/2040";
    private int $MaterialPrincipal = 1;
    private float $Precio = 30;

    private Caracteristicas $caracteristicas;

    // CONSTRUCTOR ***************************

    public function __construct(
        string $nombre,
        ?int $MaterialPrincipal,
        ?string $fabricante = "FMu",
        ?string $pais = "ESPAÑA",
        ?int $anio = 2020,
        ?string $fechaIniVenta = "01/01/2020",
        ?string $fechaFinVenta = "31/12/2040",
        ?float $Precio = 30
    ) {

        if (!$this->setNombre($nombre)) {
            throw new Exception("Error al asignar el nombre");
        }
        if ($fabricante !== null) {
            $this->setFabricante($fabricante);
        }
        if ($pais !== null) {
            $this->setPais($pais);
        }
        if ($anio !== null) {
            $this->setAnio($anio);
        }
        if ($fechaIniVenta !== null) {
            $this->setFechaIniVenta($fechaIniVenta);
        }
        if ($fechaFinVenta !== null) {
            $this->setFechaFinVenta($fechaFinVenta);
        }
        if ($MaterialPrincipal !== null) {
            $this->setMaterialPrincipal($MaterialPrincipal);
        }
        if ($Precio !== null) {
            $this->setPrecio($Precio);
        }

        self::$_mueblesCreados++;
        if (self::$_mueblesCreados > self::MAXIMO_MUEBLES) {
            throw new Exception("Se ha llegado al tope de muebles");
        }

        $this->caracteristicas = new Caracteristicas();
    }

    // MÉTODOS *******************************

    public function dameListaPropiedades()
    {
        return [
            'nombre' => $this->getNombre(),
            'fabricante' => $this->getFabricante(),
            'pais' => $this->getPais(),
            'anio' => $this->getAnio(),
            'fechaIniVenta' => $this->getFechaIniVenta(),
            'fechaFinVenta' => $this->getFechaFinVenta(),
            'MaterialPrincipal' => $this->getMaterialPrincipal(),
            'Precio' => $this->getPrecio(),
        ];
    }

    public function damePropiedad(string $propiedad, int $modo, &$res): bool
    {
        switch ($modo) {
            case 1:
                $propiedades = $this->dameListaPropiedades();
                if (validaRango($propiedad, $propiedades, 2)) {
                    $res = $propiedades[$propiedad];
                    return true;
                } else
                    return false;
            case 2:
                if (property_exists($this, $propiedad)) {
                    $res = $this->$propiedad;
                    return true;
                } else {
                    $metodo = "get" . ucfirst($propiedad);
                    if (method_exists($this, $metodo)) {
                        $res = $metodo();
                        return true;
                    } else return false;
                }
            default:
                throw new Exception("El modo debe de ser 1 o 2");
        }
    }

    public function puedeCrear(&$numero): bool
    {
        if (self::$_mueblesCreados < self::MAXIMO_MUEBLES) {
            $numero = self::MAXIMO_MUEBLES - self::$_mueblesCreados;
            return true;
        } else {
            $numero = 0;
            return false;
        }
    }

    public function añadir(...$args)
    {
        $carac = "";
        $valor = "";

        for ($i = 0; $i < count($args) - 1; $i += 2) {
            $carac = $args[$i];
            $valor = $args[$i + 1];

            $this->caracteristicas->__set($carac, $valor);
        }
    }

    public function exportarCaracteristicas(): string
    {
        $cadena = "";
        foreach ($this->caracteristicas as $car => $valor) {
            $cadena .= "$car:$valor\n";
        }
        return $cadena;
    }

    public function __toString()
    {
        return "MUEBLE de clase " . get_class($this) . "con nombre {$this->getNombre()}, fabricante {$this->getFabricante()}, fabricado en {$this->getPais()} a partir del año {$this->getAnio()}, vendido desde {$this->getFechaIniVenta()}, hasta {$this->getFechaFinVenta()}, precio {$this->getPrecio()} de material {$this->getMaterialDescripcion()} \nCaracterísticas:\n {$this->exportarCaracteristicas()}";
    }

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
        if (!validaCadena($nombre, 40, $nombre) || $nombre == "") {
            return false;
        } else {
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
            } else {
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
        if (validaCadena($pais, 20, "ESPAÑA")) {
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

            $anioFab = new DateTime("01/01/" . $this->getAnio());
            $fechaIni = DateTime::createFromFormat('d/m/Y', $fechaIniVenta);

            if ($fechaIni >= $anioFab) {
                $this->fechaIniVenta = $fechaIni->format('d/m/Y');
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
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
            $fechaFinVenta2 = DateTime::createFromFormat('d/m/Y', $fechaFinVenta);

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
        if (validaReal($Precio, 30, 999999, 30)) {
            $this->Precio = $Precio;
            return true;
        } else
            return false;
    }

    public function getMaterialDescripcion(): string
    {
        return self::MATERIALES_POSIBLES[$this->getMaterialPrincipal()];
    }

    public function __get(string $name)
    {
        throw new Exception("Propiedad '$name' no permitida");
    }

    public function __set(string $name, $value)
    {
        throw new Exception("Propiedad '$name' no permitida");
    }

    public function __isset(string $name): bool
    {
        return false;
    }

    public function __unset(string $name)
    {
        throw new Exception("Propiedad '$name' no permitida");
    }
}
