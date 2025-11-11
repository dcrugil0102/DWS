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

    private int $x = 0;
    private int $y = 0;
    private string $color = "";
    private int $grosor = 1;

    // CONSTRUCTOR *********************

    public function __construct(int $x, int $y)
        {
            if ($x !== null) {
            $this->setX($x);
            }

            if ($y !== null) {
            $this->setY($y);
            }
        }

    // GETTERS Y SETTERS *******************

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX(int $x): bool
    {
        if (validaEntero($x, 0, 20000, 0)) {
            $this->x = $x;
            return true;
        } else return false;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY(int $y): bool
    {
        if (validaEntero($y, 0, 20000, 0)) {
            $this->y = $y;
            return true;
        } else
            return false;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getGrosor(): int
    {
        return $this->grosor;
    }

    /**
     * @param int $grosor
     */
    public function setGrosor(int $grosor): void
    {
        $this->grosor = $grosor;
    }
}
