<?php
class Partida extends CActiveRecord
{
    protected function fijarNombre(): string
    {
        return 'nombre_baraja';
    }
    protected function fijarId(): string
    {
        return 'cod_partida';
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
            "cod_partida" => "Parti- Codigo de la partida",
            "mesa" => "Parti- Mesa en la que se juega",
            "fecha" => "Parti- Fecha en la que se juega la partida",
            "cod_baraja" => "Parti- Codido de la baraja con la que se juega",
            "nombre_baraja" => "Parti- Nombre de la baraja",
            "jugadores" => "Parti- Numero de jugadores que juegan",
            "crupier" => "Parti- Crupier"
        );
    }

    protected function fijarRestricciones(): array
    {
        return
            array(
                array(
                    "ATRI" => "cod_partida,cod_baraja",
                    "TIPO" => "REQUERIDO"
                ),
                array(
                    "ATRI" => "cod_partida",
                    "TIPO" => "ENTERO",
                    "MIN" => 20
                ),
                array(
                    "ATRI" => "mesa",
                    "TIPO" => "ENTERO",
                    "MIN" => 1,
                    "MAX" => 20,
                    "DEFECTO" => 1
                ),
                array(
                    "ATRI" => "fecha",
                    "TIPO" => "FECHA",
                    "MIN" => date("Y-m-d"),
                    "DEFECTO" => (new DateTime())->modify("+1 day")->format("Y-m-d")
                ),
                array(
                    "ATRI" => "cod_baraja",
                    "TIPO" => "ENTERO",
                ),
                array(
                    "ATRI" => "nombre_baraja",
                    "TIPO" => "CADENA",
                    "TAMANIO" => "30"
                ),
                array(
                    "ATRI" => "jugadores",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaJugadores"
                ),
                array(
                    "ATRI" => "crupier",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaCrupier"
                )
            );
    }

    protected function afterCreate(): void
    {
        $lista = new Listas();
        $valores =  $lista::listaTiposBarajas(true, (int)$this->cod_baraja);

        $barajas = $lista::listaTiposBarajas(true);
        $codigos = array_keys($barajas);
        if ($this->cod_baraja === null || $this->cod_baraja === "") {
            $this->cod_baraja = $codigos[floor(count($codigos) / 2)];
        }
        $this->nombre_baraja = $valores[$this->cod_baraja]["nombre"];
        if ($this->jugadores === null) {
            $this->jugadores = $valores["min_juga"];
        }
        if ($this->crupier === null) {
            $this->crupier = "Cru-Juan";
        }
    }

    public function validaJugadores()
    {
        $lista = new Listas();
        $valores =  $lista::listaTiposBarajas(true, $this->cod_baraja);
        if ($this->jugadores < $valores["min_juga"] || $this->jugadores > $valores["max_juga"]) {
            $this->setError("jugadores", "El numero de jugadores es incorrecto");
        }
    }
    public function validaCrupier()
    {
        if (mb_strlen($this->crupier) > 30) {
            $this->setError("crupier", "Crupier tiene mas de 30 caracteres");
        }
        if (mb_substr($this->crupier, 0, 4) !== "Cru-") {
            $this->setError("crupier", "No empieza por Cru-");
        }
    }
}
