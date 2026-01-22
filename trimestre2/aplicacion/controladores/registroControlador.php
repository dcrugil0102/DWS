<?php

final class registroControlador extends CControlador
{
    public function accionLogin(){
        
    }
    public function accionLogout(){
        
    }
    public function accionPedirDatosRegistro(){

        $datosRegistro = new DatosRegistro();

        $this->dibujaVista("datosRegistro",
            array("modelo"=>$datosRegistro),
            "Registrar nuevo usuario");
        }
}