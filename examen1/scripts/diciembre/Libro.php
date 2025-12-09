<?php

use Dom\CharacterData;

class Libro implements Iterator
{
    // PROPIEDADES ****************************

    private string $_nombre;
    private string $_autor;

    private $_otras = [];

    // CONSTRUCTOR **********************************

    public function __construct(string $nombre, string $autor, mixed ...$args)
    {
        $this->_nombre = $nombre;
        $this->_autor = $autor;

        $nombre_prop = "";
        $valor_prop = "";

        for ($i = 0; $i < count($args) - 1; $i += 2) {
            $nombre_prop = $args[$i];
            $valor_prop = $args[$i + 1];

            if (is_string($nombre_prop)) {
                $this->_otras[$i] = $nombre_prop;
                $this->_otras[$i + 1] = $valor_prop;
            }
        }

        $this->añadir();
        
    }

    // METODOS **************************************

    function añadir() : void {

        $prop = "";
        $valor = "";

        for ($i = 0; $i < count($this->_otras); $i += 2) {
            $prop = $this->_otras[$i];
            $valor = $this->_otras[$i + 1];

            $this->__set($prop, $valor);
        }
    }

    // PROPIEDADES DINÁMICAS ************************

    public function __set($name, $value): void
    {
        $this->$name = $value;
    }


    public function __get($name) : mixed
    {
        if (!validaRango($name, $this->_otras, 2)) {
            return false;
        }

        $name = mb_strtolower($name);
        return $this->$name;
    }

    // MÉTODOS DE ITERATOR *************************

    private $_posicion;

    public function current(): mixed
    {
        return $this->_otras[$this->_posicion];
    }

    public function key(): mixed
    {
        switch ($this->_posicion) {
            case 0:
                return "Nombre:";
            case count($this->_otras):
                return "Autor";
            default:
                return $this->_otras[$this->_posicion];
        }
    }

    public function next(): void
    {
        $this->_posicion++;
    }

    public function rewind(): void
    {
        $this->_posicion=0;
    }

    public function valid(): bool
    {
        if ($this->_posicion > count($this->_otras)) {
            return false;
        } else
            return true;
    }
}
