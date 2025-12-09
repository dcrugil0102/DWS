<?php

class Libro
{
    // PROPIEDADES ****************************

    private string $_nombre;
    private string $_autor;

    private $_otras = [];

    // PROPIEDADES DINÁMICAS ************************

    public function __set($name, $value): void
    {
        $this->_otras[$name] = $value;
    }
}
