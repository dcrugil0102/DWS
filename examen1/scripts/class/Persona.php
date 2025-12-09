<?php
class Persona
{
    private string $nombre;
    private string $fecha_nacimiento;
    private string $domicilio;
    private string $localidad;
    private EstadoCivil $estado;

    // CONSTRUCTOR **************************

    private function __construct()
    {
        $this->nombre = "prueba";
        $this->fecha_nacimiento = "01/01/2000";
        $this->domicilio = "carrera 12";
        $this->localidad = "antequera";
        $this->estado = EstadoCivil::SOLTERO;
    }

    // METODOS ******************************

    /**
     * @param string $nombre
     * @param string $fecha_nacimiento
     * @param string $domicilio
     * @param string $localidad
     * @param EstadoCivil $estado
     */
    public static function registrarPersona(
        string $nombre,
        string $fecha_nacimiento,
        string $domicilio,
        string $localidad,
        EstadoCivil $estado
    ) {
        $persona = new Persona();
        $persona->nombre = $nombre;
        $persona->fecha_nacimiento = $fecha_nacimiento;
        $persona->domicilio = $domicilio;
        $persona->localidad = $localidad;
        $persona->estado = $estado;

        return $persona;
    }

    public function __toString()
    {
        return "$this->nombre es una persona {$this->estado->descripcion()} nacida el $this->fecha_nacimiento  y que vive en $this->localidad";
    }

    // GETTERS Y SETTERS ********************

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getFecha_nacimiento(): string
    {
        return $this->fecha_nacimiento;
    }

    /**
     * @param string $fecha_nacimiento
     */
    public function setFecha_nacimiento(string $fecha_nacimiento): void
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    /**
     * @return string
     */
    public function getDomicilio(): string
    {
        return $this->domicilio;
    }

    /**
     * @param string $domicilio
     */
    public function setDomicilio(string $domicilio): void
    {
        $this->domicilio = $domicilio;
    }

    /**
     * @return string
     */
    public function getLocalidad(): string
    {
        return $this->localidad;
    }

    /**
     * @param string $localidad
     */
    public function setLocalidad(string $localidad): void
    {
        $this->localidad = $localidad;
    }

    /**
     * @return EstadoCivil
     */
    public function getEstado(): EstadoCivil
    {
        return $this->estado;
    }

    /**
     * @param EstadoCivil $estado
     */
    public function setEstado(EstadoCivil $estado): void
    {
        $this->estado = $estado;
    }
}
