<?php 

class Punto 
{
    // PROPIEDADES *******************
    public const COLORES = [
        "black" => ["nombre" => "negro", "rgb" => [0, 0, 0]],
        "red" => ["nombre" => "rojo", "rgb" => [255, 0, 0]],
        "green" => ["nombre" => "verde", "rgb" => [0, 255, 0]],
        "blue" => ["nombre" => "azul", "rgb" => [0, 0, 255]],
        "yellow" => ["nombre" => "amarillo", "rgb" => [255, 255, 0]]
    ];

    public const GROSORES = [
        1 => 'fino',
        2 => 'medio',
        3 => 'grueso'
    ];

    private int $_x = 0;
    private int $_y = 0;
    private string $_color = "";
    private int $_grosor = 1;

    // CONSTRUCTOR *********************

    public function __construct(int $x, int $y, string $color, int $grosor)
        {
            if (!$this->setX($x)) {
                throw new Exception("X debe ser entre 0 y 20000");
            }
            
            if (!$this->setY($y)) {
                throw new Exception("Y debe ser entre 0 y 20000");
            }

            if (!$this->setColor($color)) {
                throw new Exception("Color inválido");
            }

            if (!$this->setGrosor($grosor)) {
                throw new Exception("Grosor inválido");
            }
        }

    // GETTERS Y SETTERS *******************

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->_x;
    }

    /**
     * @param int $x
     */
public function setX(int $x): bool
{
    if (validaEntero($x, 0, 20000, 0)) {
        $this->_x = $x;
        return true;
    } else {
        return false;
    }
}


    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->_y;
    }

    /**
     * @param int $y
     */
    public function setY(int $y): bool
    {
        if (validaEntero($y, 0, 20000, 0)) {
            $this->_y = $y;
            return true;
        } else
            return false;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->_color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): bool
    {
        if(validaRango($color, Punto::COLORES, 2)){
            $this->_color = $color;
            return true;
        } else
            return false;
    }

    /**
     * @return int
     */
    public function getGrosor(): int
    {
        return $this->_grosor;
    }

    /**
     * @param int $grosor
     */
    public function setGrosor(int $grosor): bool
    {
        if(validaRango($grosor, Punto::GROSORES, 2)){
            $this->_grosor = $grosor;
            return true;
        } else
            return false;
    }

    // PROPIEDADES DINAMICAS *****************

    public function __set($name, $value)
    {
        throw new \Exception('Not implemented');
    }

    public function __get($name)
    {
        throw new \Exception('Not implemented');
    }

    public function __isset($name)
    {
        throw new \Exception('Not implemented');
    }

    public function __unset($name)
    {
        throw new \Exception('Not implemented');
    }
}
