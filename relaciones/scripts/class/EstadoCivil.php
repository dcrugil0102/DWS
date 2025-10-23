<?php
enum EstadoCivil: int
{
    case SOLTERO = 10;
    case CASADO = 20;
    case PAREJA = 30;
    case VIUDO = 40;

    function descripcion()
    {
        return $this->name;
    }
    function valor()
    {
        return $this->value;
    }

    static function casos()
    {
        return EstadoCivil::cases();
    }
}
