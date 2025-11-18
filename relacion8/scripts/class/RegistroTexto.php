<?php

final class RegistroTexto
{
    // PROPIEDADES *******************

    private string $_cadena;
    private DateTime $_fechaHora;

    // CONSTRUCTOR *********************

    public function __construct($cadena) {
        $this->_cadena = $cadena;
        $this->_fechaHora = new DateTime();
    }

    // GETTERS ***************************

    

    /**
     * @return string
     */
    public function get_cadena(): string
    {
        return $this->_cadena;
    }

    /**
     * @return DateTime
     */
    public function get_fechaHora(): DateTime
    {
        return $this->_fechaHora;
    }

    // PROPIEDADES DINAMICAS *********************

    public function __get($name)
    {
        throw new \Exception('Not implemented');
    }

    public function __set($name, $value)
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
