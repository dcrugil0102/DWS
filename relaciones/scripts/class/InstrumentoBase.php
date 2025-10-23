<?php

abstract class InstrumentoBase
{

    // VARIABLES *********************

    private $_descripcion = "";
    protected $_edad = 10;
    protected static $_numInstancias = 0;
    public $instancia = 0;

    // CONSTRUCTOR *******************

    function __construct($_descripcion, $edad)
    {
        $this->_descripcion = $_descripcion;
        $this->_edad = $edad;
        self::$_numInstancias++;
        $this->instancia = self::$_numInstancias;
    }

    // METODOS *********************

    abstract function sonido();
    abstract function afinar();

    /**
     * Incrementa la edad del instrumento en una unidad.
     *
     * Esta función aumenta la propiedad $edad del objeto en 1.
     * No recibe parámetros ni devuelve valor alguno.
     *
     * @return void
     */
    public function envejecer()
    {
        $this->_edad++;
    }

    public function __toString()
    {
        return "Instrumento con descripcion {$this->getDescripcion()}, instancia $this->instancia de un total de " . self::$_numInstancias . ". Tiene {$this->getEdad()} años. La clase es " . get_class($this);
    }

    // GETTERS Y SETTERS **********************

    public function setDescripcion($nuevaDescripcion)
    {
        $this->_descripcion = $nuevaDescripcion;
    }
    public function getDescripcion()
    {
        return $this->_descripcion;
    }
    public function getEdad()
    {
        return $this->_edad;
    }
}
