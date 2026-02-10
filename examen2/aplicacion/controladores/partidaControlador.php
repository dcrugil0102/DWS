<?php

class partidaControlador extends CControlador
{
    public array $menuizq = [];
    public array $menuhead = [];
    public array $Partidas = [];
    public int $N_PartidasHoy = 0;

    public function __construct()
    {

        $partida1 = new Partida();
        $partida1->cod_partida = 21;
        $partida1->mesa = 2;
        $partida1->fecha = "2026-02-09";
        $partida1->cod_baraja = 5;
        $partida1->jugadores = 2;
        $partida1->crupier = "Cru-Pedro";

        $partida2 = new Partida();
        $partida2->cod_partida = 22;
        $partida2->mesa = 3;
        $partida2->fecha = "2026-02-09";
        $partida2->cod_baraja = 6;
        $partida2->jugadores = 2;
        $partida2->crupier = "Cru-Maria";

        $partida3 = new Partida();
        $partida3->cod_partida = 23;
        $partida3->mesa = 4;
        $partida3->fecha = "2026-02-10";
        $partida3->cod_baraja = 7;
        $partida3->jugadores = 5;
        $partida3->crupier = "Cru-Luis";

        $this->Partidas[$partida1->cod_partida] = $partida1;
        $this->Partidas[$partida2->cod_partida] = $partida2;
        $this->Partidas[$partida3->cod_partida] = $partida3;



        foreach ($this->Partidas as $partida) {
            if ($partida->fecha === date("Y-m-d")) {
                $this->N_PartidasHoy++;
                Sistema::app()->añadirPartidaHoy();
            }
            Sistema::app()->añadirPartida();
        }
    }

    public function accionVer()
    {
        $this->menuizq = [
            [
                "texto" => "Inicio",
                "enlace" => ["partida"]
            ]
        ];
        $this->menuhead = [
            [
                "texto" => "Inicio",
                "enlace" => ["partida"]
            ]
        ];
        $crupiers = [];
        $PartidasCrupi = [];

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            if (isset($_GET["crupi"])) {
                foreach ($this->Partidas as $part) {
                    if ($part->crupier === $_GET["crupi"]) {
                        $PartidasCrupi[] = $part;
                    }
                }
            }
        }
        foreach ($this->Partidas as $partida) {
            if (!in_array($partida->crupier, $crupiers)) {
                $crupiers[$partida->crupier] = $partida->crupier;
            }
        }
        $this->dibujaVista("ver", ["crupiers" => $crupiers, "PartidasCrupi" => $PartidasCrupi, "crupierSelect" => $_GET["crupi"] ?? ""], "Contenido de Partida");
    }
    public function accionLogin()
    {
        $this->menuizq = [
            [
                "texto" => "Inicio",
                "enlace" => ["ver"]
            ]
        ];
        $this->menuhead = [
            [
                "texto" => "Inicio",
                "enlace" => ["ver"]
            ]
        ];

        if ($this->N_PartidasHoy >= 1) {
            Sistema::app()->Acceso()->registrarUsuario("Pablog", "Pablo Granados", [2 => true, 4 => true, 6 => true]);
        } else {
            Sistema::app()->paginaError(404, "No puedes logearte porque no tienes ninguna partida hoy");
        }
        Sistema::app()->irAPagina(["partida", "ver"]);
    }
    public function accionlogout()
    {
        $this->menuizq = [
            [
                "texto" => "Inicio",
                "enlace" => ["ver"]
            ]
        ];
        $this->menuhead = [
            [
                "texto" => "Inicio",
                "enlace" => ["ver"]
            ]
        ];

        if (Sistema::app()->numeroPartidas() >= 2) {
            Sistema::app()->Acceso()->quitarRegistroUsuario();
        } else {
            Sistema::app()->paginaError(404, "No puedes hacer el logout porque o no tienes usuario iniciado o no tienes el numero de partidas necesario");
        }
        Sistema::app()->irAPagina(["partida", "ver"]);
    }
    public function accionDescargar()
    {
        $this->menuizq = [
            [
                "texto" => "Inicio",
                "enlace" => ["ver"]
            ]
        ];
        $this->menuhead = [
            [
                "texto" => "Inicio",
                "enlace" => ["ver"]
            ]
        ];
        $cod = $_GET["cod"] ?? null;
        if ($cod === null || !isset($this->Partidas[$cod])) {
            echo "Partida no encontrada";
            return;
        }
        $partida = $this->Partidas[$cod];

        $contenido = "Codigo de Partida: " . $partida->cod_partida . "\n";
        $contenido .= "Numero de Mesa: " . $partida->mesa . "\n";
        $contenido .= "Fecha de la Partida: " . $partida->fecha . "\n";
        $contenido .= "Codigo de Baraja: " . $partida->cod_baraja . "\n";
        $contenido .= "Numero de Jugadores: " . $partida->jugadores . "\n";
        $contenido .= "Crupier de la Partida: " . $partida->crupier . "\n";


        header("Content-Type: text/plain");
        header("Content-Disposition: attachment; filename=partida_{$partida->cod_partida}.txt");
        echo $contenido;
        exit;
    }
    public function accionNueva()
    {
        $this->menuizq = [
            [
                "texto" => "Inicio",
                "enlace" => ["ver"]
            ]
        ];
        $this->menuhead = [
            [
                "texto" => "Inicio",
                "enlace" => ["ver"]
            ]
        ];
        $this->dibujaVista("nueva", [], "Nueva Partida");
        echo $_GET["cod_baraja"];
    }
}
