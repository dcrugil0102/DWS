<?php

class pueblosControlador extends CControlador
{
    public array $menu = [];
    public array $barraUbi = [];
    public array $menuizq = [];
    public array $actual = [];
    private array $_MisPueblos = [];
    public int $N_PueblosUnesco = 0;

    public function __construct()
    {
        $this->menu = require __DIR__ . "/../config/menu.php";
        $this->menuizq = $this->menu['pueblos']['hijos'];

        $pueblo1 = new Pueblo();
        $pueblo1->nombre = "Antequera";
        $pueblo1->cod_tipo_elemento = 1;
        $pueblo1->elemento = "Elemento-Antequera";
        $pueblo1->reconocido_unesco = 0;
        $pueblo1->fecha_reconocimiento = "2026-02-09";

        $pueblo2 = new Pueblo();
        $pueblo2->nombre = "Cartaojal";
        $pueblo2->cod_tipo_elemento = 4;
        $pueblo2->elemento = "Elemento-Cartaojal";
        $pueblo2->reconocido_unesco = 1;
        $pueblo2->fecha_reconocimiento = "2025-05-17";

        $this->_MisPueblos[] = $pueblo1;
        $this->_MisPueblos[] = $pueblo2;

        foreach ($this->_MisPueblos as $pueblo) {
            if ($pueblo->reconocido_unesco) {
                $this->N_PueblosUnesco++;
                Sistema::app()->anadirPuebloUnesco();
            }
            Sistema::app()->anadirPueblo();
        }
    }

    public function accionConectar() {

        $rand = rand(1, 1000) % 6;

        if ($rand % 2 === 0) {
            Sistema::app()->Acceso()->registrarUsuario("pueblo", "pueblo", [5 => true]);
        }
        
        Sistema::app()->irAPagina(["pueblos", "puebloInicial"]);
    }
    public function accionDesconectar()
    {
        if (Sistema::app()->Acceso()->hayUsuario()) {
            Sistema::app()->Acceso()->quitarRegistroUsuario();
        } else {
            Sistema::app()->paginaError(404, "No hay ningun usuario conectado!");
        }
        Sistema::app()->irAPagina(["pueblos", "puebloInicial"]);
    }

    public function accionPuebloInicial()
    {
        $this->barraUbi = $this->menu;
		$this->actual = $this->menu["pueblos"];

        $pueblos = [];

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            if (isset($_GET["unesco"])) {

                if ($_GET['unesco'] == 1) {
                    
                    foreach ($this->_MisPueblos as $key => $pueblo) {
                        
                        if ($pueblo->reconocido_unesco == 1) {
                            $pueblos[] = $pueblo;  
                        }
                    }

                } else {
                    foreach ($this->_MisPueblos as $key => $pueblo) {
                        
                        if ($pueblo->reconocido_unesco == 0) {
                            $pueblos[] = $pueblo;    
                        }
                    }
                }
            }
        }
        $this->dibujaVista("puebloInicial", ["pueblos" => $pueblos], "Pueblo Inicial");
    }

        public function accionNuevo()
    {
           $this->actual = [
            "texto" => "Nuevo pueblo",
            "enlace" => ["pueblos", "nuevo"]
        ];


        $pueblo = new Pueblo();

        $nombre = $pueblo->getNombre();

        if (isset($_POST[$nombre])) {

            $pueblo->setValores($_POST[$nombre]);

            if ($pueblo->validar()) {

                Sistema::app()->irAPagina(["pueblos", "puebloInicial"]);
            } else {
                $this->dibujaVista(
                    "nuevo",
                    array("modelo" => $pueblo),
                    "Nuevo pueblo"
                );
                exit;
            }
        }

        $this->dibujaVista(
            "nuevo",
            array("modelo" => $pueblo),
            "Nuevo pueblo"
        );
        
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

}
