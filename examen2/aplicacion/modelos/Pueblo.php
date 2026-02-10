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
        // $fechaHoy = new DateTime();
        // $this->fecha = $fechaHoy->modify("+1 day");

        // $barajas = Listas::listaTiposBarajas(true);

        // $this->cod_baraja = floor(count($barajas) / 2);
        // $codigo = array_keys($barajas);
        // $this->nombre_baraja = $barajas[$codigo[$this->cod_baraja]]['nombre'];
        // $this->jugadores = $barajas[$codigo[$this->cod_baraja]]['min_juga'];
        $this->nombre = "Pueblo";
        $this->cod_tipo_elemento = 0;
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

    public function validaFecha()
    {

        $fechaHoy = new DateTime();

        if ($this->fecha < $fechaHoy) {
            $this->setError("fecha", "La fecha no puede ser anterior al dia de hoy");
        }
    }

    public function validaJugadores()
    {
        $baraja = Listas::listaTiposBarajas(true, $this->cod_baraja);

        if ($this->jugadores < $baraja['min_juga'] & $this->jugadores > $baraja['max_juga']) {
            $this->setError("jugadores", "Número de jugadores inválido!");
        }
    }
    public function validaCrupier()
    {
        if (mb_substr($this->crupier, 0, 4) !== "Cru-") {
            $this->setError("crupier", "Nombre de crupier inválido! Debe empezar por Cru-");
        }
    }
}
