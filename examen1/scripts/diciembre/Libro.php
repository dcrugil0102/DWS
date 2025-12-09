<?php

class Libro
{
    // PROPIEDADES ****************************

    private string $_nombre;
    private string $_autor;

    private $_otras = [];

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
