<?php

class pueblosControlador extends CControlador
{
    public array $menuizq = [];
    public array $menuhead = [];
    private array $_MisPueblos = [];
    public int $N_PueblosUnesco = 0;

    public function __construct()
    {

        $pueblo1 = new Pueblo();
        $pueblo1->nombre = "Antequera";
        $pueblo1->cod_tipo_elemento = 1;
        $pueblo1->elemento = "Elemento";
        $pueblo1->reconocido_unesco = 0;
        $pueblo1->fecha_reconocimiento = "2026-02-09";

        $pueblo2 = new Pueblo();
        $pueblo2->nombre = "Cartaojal";
        $pueblo2->cod_tipo_elemento = 4;
        $pueblo2->elemento = "Elemento";
        $pueblo2->reconocido_unesco = 1;
        $pueblo2->fecha_reconocimiento = "2025-05-17";

        $this->_MisPueblos[] = $pueblo1;
        $this->_MisPueblos[] = $pueblo2;

        foreach ($this->_MisPueblos as $pueblo) {
            if ($pueblo->reconocido_unesco) {
                $this->N_PueblosUnesco++;
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
        $_MisPueblosCrupi = [];

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            if (isset($_GET["crupi"])) {
                foreach ($this->_MisPueblos as $part) {
                    if ($part->crupier === $_GET["crupi"]) {
                        $_MisPueblosCrupi[] = $part;
                    }
                }
            }
        }
        foreach ($this->_MisPueblos as $partida) {
            if (!in_array($partida->crupier, $crupiers)) {
                $crupiers[$partida->crupier] = $partida->crupier;
            }
        }
        $this->dibujaVista("ver", ["crupiers" => $crupiers, "_MisPueblosCrupi" => $_MisPueblosCrupi, "crupierSelect" => $_GET["crupi"] ?? ""], "Contenido de Partida");
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

        if ($this->N__MisPueblosHoy >= 1) {
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

        if (Sistema::app()->numero_MisPueblos() >= 2) {
            Sistema::app()->Acceso()->quitarRegistroUsuario();
        } else {
            Sistema::app()->paginaError(404, "No puedes hacer el logout porque o no tienes usuario iniciado o no tienes el numero de _MisPueblos necesario");
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
        if ($cod === null || !isset($this->_MisPueblos[$cod])) {
            echo "Partida no encontrada";
            return;
        }
        $partida = $this->_MisPueblos[$cod];

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
