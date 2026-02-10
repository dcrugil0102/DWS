<?php

class Partida extends CActiveRecord
{
    protected function fijarNombre(): string
    {
        return "partida";
    }

    protected function fijarAtributos(): array
    {
        return array(
            "cod_partida",
            "mesa",
            "fecha",
            "cod_baraja",
            "nombre_baraja",
            "jugadores",
            "crupier"
        );
    }

    protected function fijarDescripciones(): array
    {
        return array(
            "cod_partida"  => "Código de partida",
            "mesa"        => "Mesa de la partida",
            "fecha"      => "Fecha de la partida",
            "cod_baraja" => "Código de la baraja",
            "nombre_baraja" => "Nombre de la baraja",
            "jugadores"    => "Número de jugadores",
            "crupier"    => "Nombre del crupier",
        );
    }

    protected function fijarRestricciones(): array
    {
        return
            array(
                array(
                    "ATRI" => "cod_partida, cod_baraja",
                    "TIPO" => "REQUERIDO"
                ),
                array(
                    "ATRI" => "cod_partida",
                    "TIPO" => "ENTERO"
                ),
                array(
                    "ATRI" => "cod_partida",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaCodPartida"
                ),
                array(
                    "ATRI" => "mesa",
                    "TIPO" => "RANGO",
                    "RANGO" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
                    "DEFECTO" => 1,
                ),
                array(
                    "ATRI" => "fecha",
                    "TIPO" => "FECHA"
                ),
                array(
                    "ATRI" => "fecha",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaFecha"
                ),
                array(
                    "ATRI" => "cod_baraja",
                    "TIPO" => "ENTERO",
                ),
                array(
                    "ATRI" => "cod_baraja",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaCodBaraja"
                ),
                array(
                    "ATRI" => "nombre_baraja",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 30
                ),
                array(
                    "ATRI" => "jugadores",
                    "TIPO" => "ENTERO",
                ),
                array(
                    "ATRI" => "jugadores",
                    "TIPO" => "FUNCION",
                    "FUNCION"  =>   "validaJugadores"
                ),
                array(
                    "ATRI" => "crupier",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 30,
                    "DEFECTO" => "Cru-Juan"
                ),
                array(
                    "ATRI" => "crupier",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaCrupier"
                ),

            );
    }

    public function afterCreate(): void
    {
        $fechaHoy = new DateTime();
        $this->fecha = $fechaHoy->modify("+1 day");

        $barajas = Listas::listaTiposBarajas(true);

        $this->cod_baraja = floor(count($barajas) / 2);
        $codigo = array_keys($barajas);
        $this->nombre_baraja = $barajas[$codigo[$this->cod_baraja]]['nombre'];
        $this->jugadores = $barajas[$codigo[$this->cod_baraja]]['min_juga'];
    }

    public function validaCodPartida()
    {
        if ($this->cod_partida > 20) {
            $this->setError("cod_partida", "El código no puede ser mayor de 20");
        }
    }
    public function validaFecha()
    {

        $fechaHoy = new DateTime();

        if ($this->fecha < $fechaHoy) {
            $this->setError("fecha", "La fecha no puede ser anterior al dia de hoy");
        }
    }
    public function validaCodBaraja()
    {
        $codigos = Listas::listaTiposBarajas(true);

        if (!array_key_exists($this->cod_baraja, $codigos)) {
            $this->setError("cod_baraja", "El código de baraja no existe!");
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
