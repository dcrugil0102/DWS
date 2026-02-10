<?php

class Pueblo extends CActiveRecord
{
    protected function fijarNombre(): string
    {
        return "pueblo";
    }

    protected function fijarAtributos(): array
    {
        return array(
            "nombre",
            "cod_tipo_elemento",
            "descripcion_tipo",
            "elemento",
            "reconocido_unesco",
            "fecha_reconocimiento",
        );
    }

    protected function fijarDescripciones(): array
    {
        return array(
            "nombre" => "Nombre del pueblo",
            "cod_tipo_elemento" => "Código del tipo de elemento",
            "descripcion_tipo" => "Descripcion del tipo",
            "elemento" => "Tipo de elemento",
            "reconocido_unesco" => "Reconocido por la UNESCO",
            "fecha_reconocimiento" => "Fecha de reconocimiento por la UNESCO",
        );
    }

    protected function fijarRestricciones(): array
    {
        return
            array(
                array(
                    "ATRI" => "nombre",
                    "TIPO" => "REQUERIDO"
                ),
                array(
                    "ATRI" => "nombre",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 25,
                    "DEFECTO" => "Pueblo"
                ),
                array(
                    "ATRI" => "nombre",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaNombre"
                ),
                array(
                    "ATRI" => "cod_tipo_elemento",
                    "TIPO" => "ENTERO",
                    "DEFECTO" => 0,
                ),
                array(
                    "ATRI" => "cod_tipo_elemento",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaCodTipoElemento"
                ),
                array(
                    "ATRI" => "descripcion_tipo",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 30,
                    "DEFECTO" => "No indicado"
                ),
                array(
                    "ATRI" => "elemento",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 35,
                    "DEFECTO" => "Ele-"
                ),
                array(
                    "ATRI" => "reconocido_unesco",
                    "TIPO" => "RANGO",
                    "RANGO" => [0,1],
                    "DEFECTO" => 0
                ),
                array(
                    "ATRI" => "fecha_reconocimiento",
                    "TIPO" => "FECHA",
                    "DEFECTO" => new DateTime("1958-07-15")
                ),
                array(
                    "ATRI" => "fecha_reconocimiento",
                    "TIPO" => "FECHA",
                    "FUNCION" => "validaFecha"
                ),

            );
    }

    public function afterCreate(): void
    {
        $this->nombre = "Pueblo";
        $this->cod_tipo_elemento = 0;

        $tipos = Listas::listaTiposElemento(null, false);
        $tipos[0] = "No indicado";

        $this->descripcion_tipo = $tipos[$this->cod_tipo_elemento];
        $this->elemento = "Ele-";
        $this->reconocido_unesco = 0;
        $this->fecha_reconocimiento = new DateTime("1958-07-15");
    }

    public function validaNombre(){
        if ($this->nombre === "") {
            $this->setError("nombre", "El nombre es obligatorio");
            $this->nombre = "Pueblo";
        }
    }

        public function validaCodTipoElemento(){
        $codigos = [0 => "No indicado"];
        $codigos[] = Listas::listaTiposElemento(null, false);

        if (!array_key_exists($this->cod_tipo_elemento, $codigos)) {
            $this->setError("cod_tipo_elemento", "El código del tipo de elemento no existe!");
            $this->cod_tipo_elemento = 0;
        }
    }

    public function validaFecha() {

        $fechaHoy = new DateTime();
        $fechaAntigua = new DateTime("01/01/1973");

        if ($this->reconocido_unesco === 1) {
            if ($this->fecha_reconocimiento < $fechaAntigua || $this->fecha_reconocimiento > $fechaHoy) {
                $this->setError("fecha_reconocimiento", "Fecha inválida");
                $this->fecha_reconocimiento = new DateTime("1958-07-15");
            }
        } else{
            if ($this->fecha_reconocimiento > $fechaHoy) {
                $this->setError("fecha_reconocimiento", "La fecha no puede ser anterior al dia de hoy");
                $this->fecha_reconocimiento = new DateTime("1958-07-15");
            }
        }
    }
}
