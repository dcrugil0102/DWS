<?php

class DatosRegistro extends CActiveRecord
{
    protected function fijarNombre(): string
    {
        return 'DatosRegistro';
    }

    protected function fijarAtributos(): array
    {
        return array(
            "nick",
            "nif",
            "fecha_nacimiento",
            "provincia",
            "estado",
            "contrasenia",
            "confirmar_contrasenia"
        );
    }

    protected function fijarDescripciones(): array
    {
        return array(
            "nick" => "Nick de usuario",
            "nif" => "NIF",
            "fecha_nacimiento" => "Fecha de nacimiento",
            "provincia" => "Provincia",
            "estado" => "Estado",
            "contrasenia" => "Contraseña",
            "confirmar_contrasenia" => "Confirmar contraseña"
        );
    }

    protected function fijarRestricciones(): array
    {
        return
            array(
                array(
                    "ATRI" => "nick,nif",
                    "TIPO" => "REQUERIDO"
                ),
                array(
                    "ATRI" => "nick",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 40
                ),
                array(
                    "ATRI" => "nif",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 10
                ),
                array("ATRI" => "fecha_nacimiento", "TIPO" => "FECHA"),
                array(
                    "ATRI" => "fecha_nacimiento",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaFechaNac"
                ),
                array(
                    "ATRI" => "provincia",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 30,
                    "DEFECTO" => "MALAGA"
                ),
                array(
                    "ATRI" => "estado",
                    "TIPO" => "RANGO",
                    "RANGO" => [0,1,2,3,4],
                    "DEFECTO" => 0
                ),
                array(
                    "ATRI" => "contrasenia,confirmar_contrasenia",
                    "TIPO" => "CADENA",
                    
                ),
                array(
                    "ATRI" => "contrasenia,confirmar_contrasenia",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaContrasenia"
                ),
                
            );
    }

    protected function afterCreate(): void
    {
        $this->fecha_nacimiento = date('d/m/Y', strtotime('-18 years'));
    }

    public function validaFechaNac()
    {
        $fecha1 = DateTime::createFromFormat(
            'd/m/Y',
            $this->fecha_nacimiento
        );
        $fecha2 = DateTime::createFromFormat(
            'd/m/Y',
            '01/01/1900'
        );
        $fecha3 = new DateTime();

        if ($fecha1 < $fecha2) {
            $this->setError(
                "fecha_alta",
                "La fecha de nacimiento debe ser posterior a 01/01/1900"
            );
        }
        if ($fecha1 > $fecha3) {
            $this->setError(
                "fecha_alta",
                "La fecha de nacimiento debe ser anterior a la fecha de hoy"
            );
        }
    }

    public function validaContrasenia(){
        $pass1 = $this->contrasenia;
        $pass2 = $this->confirmar_contrasenia;

        if ($pass1 !== $pass2) {
            $this->setError(
                "confirmar_contrasenia",
                "Las contraseñas no coinciden"
            );
        }

        if ($pass1 === "") {
            $this->setError(
                "contrasenia",
                "Debes especificar una contraseña"
            );
        }
    }

    public static function dameEstados($cod_estado){

        $estados = [
            0 => "No se sabe",
            1 => "Estudiando",
            2 => "Trabajando",
            3 => "En paro",
            4 => "Jubilado",
        ];

        if(is_null($cod_estado)){
            return $estados;
        } else {
            if (isset($estados[$cod_estado]))
                return $estados[$cod_estado];

            else
                return false;
        }
    }

}
