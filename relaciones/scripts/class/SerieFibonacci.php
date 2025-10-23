<?php

class SerieFibonacci implements Iterator
{

    private int $_limite;
    private int $_claveActual;

    public function __construct($limite)
    {
        $this->_limite = $limite;
    }

    public function rewind(): void
    {
        // Volvemos al inicio
        $this->_claveActual = 0;
    }

    public function current(): mixed
    {
        return $this->fibonacci($this->_claveActual);
    }

    public function key(): mixed
    {
        return $this->_claveActual;
    }

    public function next(): void
    {
        $this->_claveActual++;
    }

    public function valid(): bool
    {
        return $this->_claveActual <= $this->_limite;
    }

    private function fibonacci($n)
    {
        if ($n < 2) return $n;
        return $this->fibonacci($n - 1) + $this->fibonacci($n - 2);
    }


    public static function fFibonacci($ultimo)
    {
        $a = 0;
        $b = 1;
        for ($i = 0; $i <= $ultimo; $i++) {
            yield $a;
            $temp = $a + $b;
            $a = $b;
            $b = $temp;
        }
    }
}

foreach (new SerieFibonacci(10) as $valor) {
    echo "$valor ";
}
