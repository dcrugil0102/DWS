<?php

class Coleccion
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
    private array $_libros = [];

    // CONSTRUCTOR **********************

    public function __construct(string $nombre, ?string $fecha_alta = '01/10/2025', ?int $tematica = 10)
    {   
        if ($this->set_nombre($nombre) === -10) {
            throw new Exception("Error al asignar el nombre");
        }

        if ($fecha_alta !== null) {
            $this->set_fecha_alta($fecha_alta);
        }

        if ($tematica !== null) {
            $this->set_tematica($tematica);
        }

        foreach (self::TEMATICAS as $key => $value) {
            if ($this->get_tematica() === $value) {
                $this->_tematica_descripcion = $key;
            }
        }
    }

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

        $fechaActual = new DateTime('now');
        $fechaActual = $fechaActual->format('d/m/Y');

        $temp = explode("/", $fechaActual);
        $dia = (int)$temp[0];
        $mes = (int)$temp[1];
        $anio = (int)$temp[2];

        $fechaAnterior = DateTime::createFromFormat('d/m/Y', $dia . '/' . $mes . '/' . $anio + 4);

        if ($_fecha_alta > $fechaActual || $_fecha_alta < $fechaAnterior) {
            return -10;
        } else{
            $this->_fecha_alta = $_fecha_alta;
            return 10;
        }
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
    public function set_tematica(int $_tematica): int
    {
        if (!validaRango($_tematica, self::TEMATICAS, 1)) {
            return -10;
        } else{
            $this->_tematica = $_tematica;
            return 10;
        }
    }

    /**
     * @return string
     */
    public function get_tematica_descripcion(): string
    {
        return $this->_tematica_descripcion;
    }

    // toString *************************************

    public function __toString()
    {
        return "colección {$this->get_nombre()} añadida el {$this->get_fecha_alta()} de temática {$this->get_tematica_descripcion()}";
    }

    // METODOS DE LIBRO *****************************

    function aniadirLibro(Libro $libro) : bool {
        if (!($libro instanceof Libro)) {
            return false;
        }

        $this->_libros[] = $libro;
        return true;
    }

    function dameLibros() : array {

        $result = [];

        foreach ($this->_libros as $n => $libro) {
            $result['libro' . $n + 1] = $libro;
        }

        return $result;
    }

    // PROPIEDADES DINÁMICAS ************************

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

