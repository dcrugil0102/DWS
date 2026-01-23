<?php

final class registroControlador extends CControlador
{

    public array $menu = [];
    public array $barraUbi = [];
    public array $menuizq = [];
    public array $actual = [];

    public function __construct()
    {
        $this->menu = require __DIR__ . "/../config/menu.php";
    }
    public function accionLogin() {}
    public function accionLogout() {}
    public function accionPedirDatosRegistro()
    {

        $this->actual = [
            "texto" => "Registro Usuario",
            "enlace" => ["registro", "pedirDatosRegistro"]
        ];


        $datosRegistro = new DatosRegistro();

        $nombre = $datosRegistro->getNombre();

        if (isset($_POST[$nombre])) {

            $datosRegistro->setValores($_POST[$nombre]);

            if ($datosRegistro->validar()) {

                // Sistema::app()->irAPagina(
                //     array(
                //         "registro",
                //         "datosUsuario"
                //     )
                // );
                $this->dibujaVista("datosUsuario", ["modelo" => $datosRegistro], "Datos del usuario");
                exit;
            } else {
                $this->dibujaVista(
                    "datosRegistro",
                    array("modelo" => $datosRegistro),
                    "Crear nuevo usuario"
                );
                exit;
            }
        }

        $this->dibujaVista(
            "datosRegistro",
            array("modelo" => $datosRegistro),
            "Registrar nuevo usuario"
        );
    }

    // public function accionDatosUsuario()
    // {
    //     $this->actual = [
    //         "texto" => "Datos Usuario",
    //         "enlace" => ["registro", "datosUsuario"]
    //     ];

    //     $this->dibujaVista("datosUsuario", [], "Datos del usuario");
    // }
}
