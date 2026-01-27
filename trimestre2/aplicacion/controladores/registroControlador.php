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

        session_start();
    }
    public function accionLogin()
    {

        $this->actual = [
            "texto" => "Login Usuario",
            "enlace" => ["registro", "login"]
        ];


        $login = new Login();

        $nombre = $login->getNombre();

        if (isset($_POST[$nombre])) {

            $login->setValores($_POST[$nombre]);

            if ($login->validar()) {

                Sistema::app()->irAPagina(["inicial", "index"]);

                $_SESSION['login'] = $login;
            } else {
                $this->dibujaVista(
                    "login",
                    array("modelo" => $login),
                    "Inicio de sesión"
                );
                exit;
            }
        }

        $this->dibujaVista(
            "login",
            array("modelo" => $login),
            "Inicio de sesión"
        );
    }
    public function accionLogout()
    {
        unset($_SESSION['login']);
        Sistema::app()->irAPagina(["inicial", "index"]);
        exit;
    }
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
}
