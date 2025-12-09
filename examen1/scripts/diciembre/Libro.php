<?php

use Dom\CharacterData;

class Libro
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
}
