<?php
class ClaseMisPropiedades implements Iterator
{
    public mixed $propPublica;
    private mixed $_propPrivada = 25;
    private array $_propiedades = [];
    private array $_iterKeys = [];
    private int $_iterIndex = 0;

    public function __set($nombre, $valor): void
    {
        if ($nombre === '_propPrivada') {
            throw new Exception("No se puede modificar la propiedad privada '_propPrivada'.");
        }
        $this->_propiedades[$nombre] = $valor;
    }

    public function __get($nombre): mixed
    {
        if ($nombre === '_propPrivada') {
            throw new Exception("No se puede acceder directamente a la propiedad privada '_propPrivada'.");
        }
        if (!array_key_exists($nombre, $this->_propiedades)) {
            throw new Exception("La propiedad dinámica '$nombre' no existe.");
        }
        return $this->_propiedades[$nombre];
    }

    public function getPropPrivada(): mixed
    {
        return $this->_propPrivada;
    }

    public function getPropiedades(): array
    {
        return $this->_propiedades;
    }

    // ----------- Métodos de Iterator -----------
    public function rewind(): void
    {
        $this->_iterKeys = array_keys($this->_propiedades);
        $this->_iterKeys[] = 'propPublica';
        $this->_iterKeys[] = '_propPrivada';
        $this->_iterIndex = 0;
    }

    public function current(): mixed
    {
        $key = $this->_iterKeys[$this->_iterIndex];
        if ($key === 'propPublica') return $this->propPublica;
        if ($key === '_propPrivada') return $this->_propPrivada;
        return $this->_propiedades[$key];
    }

    public function key(): mixed
    {
        return 'oi_' . $this->_iterKeys[$this->_iterIndex];
    }

    public function next(): void
    {
        $this->_iterIndex++;
    }

    public function valid(): bool
    {
        return $this->_iterIndex < count($this->_iterKeys);
    }
}
