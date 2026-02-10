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
        $pueblo1->asignarDescripcion();
        $pueblo1->elemento = "Elemento-Antequera";
        $pueblo1->reconocido_unesco = 0;
        $pueblo1->fecha_reconocimiento = "2026-02-09";

        $pueblo2 = new Pueblo();
        $pueblo2->nombre = "Cartaojal";
        $pueblo2->cod_tipo_elemento = 4;
        $pueblo2->asignarDescripcion();
        $pueblo2->elemento = "Elemento-Cartaojal";
        $pueblo2->reconocido_unesco = 1;
        $pueblo2->fecha_reconocimiento = "2025-05-17";

        $this->_MisPueblos[] = $pueblo1;
        $this->_MisPueblos[] = $pueblo2;

        if (isset($_SESSION['pueblos'])) {
            foreach ($_SESSION['pueblos'] as $key => $pueblo) {
                $this->_MisPueblos[] = $pueblo;
            }
        } 
        

        foreach ($this->_MisPueblos as $id => $pueblo) {
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

            if (mb_strlen($pueblo->nombre) < 5 || !str_contains("-", $pueblo->nombre)) {
                $pueblo->setError("nombre", "Nombre inválido");
            }

            $pueblo->setValores($_POST[$nombre]);

            if ($pueblo->validar()) {
                $pueblo->
                $_SESSION['pueblos'][] = $pueblo;

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

        if (!Sistema::app()->acceso()->puedePermiso(5)) {
            Sistema::app()->paginaError(500, "No tienes permisos para entrar en esta pagina");
            return;
        }

        $id = $_GET["id"] ?? null;
        if ($id === null || !isset($this->_MisPueblos[$id])) {
            Sistema::app()->paginaError(500, "Pueblo no encontrado");
            return;
        }
        $pueblo = $this->_MisPueblos[$id];

        $contenido = "<pueblo>\n";
        $contenido .= "\t<nombre>" . $pueblo->nombre . "<nombre>\n";
        $contenido .= "\t<cod_tipo_elemento>" . $pueblo->cod_tipo_elemento . "<cod_tipo_elemento>\n";
        $contenido .= "\t<descripcion_tipo>" . $pueblo->descripcion_tipo . "<descripcion_tipo>\n";
        $contenido .= "\t<elemento>" . $pueblo->elemento . "<elemento>\n";
        $contenido .= "\t<reconocido_unesco>" . $pueblo->reconocido_unesco . "<reconocido_unesco>\n";
        $contenido .= "\t<fecha_reconocimiento>" . $pueblo->fecha_reconocimiento . "<fecha_reconocimiento>\n";
        $contenido .= "<pueblo>";


        header("Content-Type: text/plain");
        header("Content-Disposition: attachment; filename=pueblo_{$pueblo->nombre}.xml");
        echo $contenido;
        exit;
    }

}
