<?php

class coleccion
{

    // CONSTANTES ******************

    public const TEMATICAS = [
        'cienciaficcion' => 10,
        'terror' => 20,
        'policiaco' => 30,
        'comedia' => 40
    ];

    // PROPIEDADES *******************   

    protected string $_nombre;
    protected string $_fecha_alta = '01/10/2025';
    protected int $_tematica = 10;
    protected string $_tematica_descripcion;

    // CONSTRUCTOR **********************



    // GETTERS Y SETTERS *****************

    /**
     * @return string
     */
    public function get_nombre(): string
    {
        return $this->_nombre;
    }

    /**
     * @param string $_nombre
     */
    public function set_nombre(string $_nombre): int
    {
        if (!validaCadena($_nombre, 40, -10) || empty($_nombre)) {
            return -10;
        } else{
            $this->_nombre = $_nombre;
            return 10;
        }
    }

    /**
     * @return string
     */
    public function get_fecha_alta(): string
    {
        return $this->_fecha_alta;
    }

    /**
     * @param string $_fecha_alta
     */
    public function set_fecha_alta(string $_fecha_alta): int
    {
        if (!validaFecha($_fecha_alta, '01/10/2025')) {
            return -10;
        }

        $fechaActual = DateTime::createFromFormat('d/m/Y', 'now');
        
        $temp = explode("/", $fechaActual);
        $dia = (int)$temp[0];
        $mes = (int)$temp[1];
        $anio = (int)$temp[2];

        $fechaAnterior = DateTime::createFromFormat('d/m/Y', $dia . '/' . $mes . '/' . $anio + 4);
    }

    /**
     * @return int
     */
    public function get_tematica(): int
    {
        return $this->_tematica;
    }

    /**
     * @param int $_tematica
     */
    public function set_tematica(int $_tematica): void
    {
        $this->_tematica = $_tematica;
    }
}

