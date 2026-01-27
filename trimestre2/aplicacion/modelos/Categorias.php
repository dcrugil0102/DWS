<?php

class Login extends CActiveRecord
{
    protected function fijarNombre(): string
    {
        return 'Categorias';
    }

    protected function fijarAtributos(): array
    {
        return array(
            "cod_categoria",
            "descripcion"
        );
    }

    protected function fijarDescripciones(): array
    {
        return array(
            "nick" => "Nick de usuario",
            "contrasenia" => "Contraseña"
        );
    }

    protected function fijarRestricciones(): array
    {
        return
            array(
                array(
                    "ATRI" => "nick,contrasenia",
                    "TIPO" => "REQUERIDO"
                ),
                array(
                    "ATRI" => "nick,contrasenia",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 20
                ),
                array(
                    "ATRI" => "contrasenia",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaContrasenia"
                )

            );
    }

    public function validaContrasenia()
    {
        $pass1 = $this->contrasenia;

        if ($pass1 !== "c-nick") {
            $this->setError(
                "contrasenia",
                "Contraseña incorrecta"
            );
        }
    }
}
