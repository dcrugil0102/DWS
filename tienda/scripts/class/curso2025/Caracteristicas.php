<?php

class Caracteristicas implements IteratorAggregate
{

    // caracteristicas ***********************************
    private array $caracteristicas = [];

    // CONSTRUCTOR ***********************************

    public function __construct()
    {
        $this->caracteristicas['ancho'] = 100;
        $this->caracteristicas['alto']  = 100;
        $this->caracteristicas['largo'] = 100;
    }

    // METODOS DINAMICOS *****************************

    public function __get(string $nombre)
    {
        return $this->caracteristicas[$nombre] ?? null;
    }

    public function __isset(string $nombre): bool
    {
        return isset($this->caracteristicas[$nombre]);
    }

    public function __unset(string $nombre): void
    {
        unset($this->caracteristicas[$nombre]);
    }

    // METODOS ***************************************

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->caracteristicas);
    }

    public function __set(string $nombre, $valor): void
    {
        if (validaRango('ningunamas', $this->caracteristicas, 2) && !$this->__isset($nombre)) {
            throw new Exception("No se pueden añadir mas caracteristicas.");
        } else if (in_array($nombre, ['largo', 'alto', 'ancho']) && !is_int($valor)) {
            throw new Exception("Las propiedades de tamaño deben de ser numeros enteros.");
        } else $this->caracteristicas[$nombre] = $valor;
    }
}
