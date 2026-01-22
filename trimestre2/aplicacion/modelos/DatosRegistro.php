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
                array(
                    "ATRI" => "descripcion",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 60
                ),
                array(
                    "ATRI" => "cod_fabricante",
                    "TIPO" => "ENTERO",
                    "MIN" => 0
                ),
                array("ATRI" => "fecha_alta", "TIPO" => "FECHA"),
                array(
                    "ATRI" => "fecha_alta",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaFechaAlta"
                ),
            );
    }

    protected function afterCreate(): void
    {
        $this->cod_articulo = 0;
        $this->nombre = "";
        $this->descripcion = "";
        $this->cod_fabricante = 1;
        $this->fabricante_nombre = "SIN INDICAR";
    }

    public function validaFechaAlta()
    {
        $fecha1 = DateTime::createFromFormat(
            'd/m/Y',
            $this->fecha_alta
        );
        $fecha2 = DateTime::createFromFormat(
            'd/m/Y',
            '01/01/2000'
        );
        if ($fecha1 < $fecha2) {
            $this->setError(
                "fecha_alta",
                "La fecha de alta debe ser posterior a
01/01/2000"
            );
        }
    }

    public static function listaFabricantes($fabricante = null)
    {
        $fabricantes = array(
            1 => "Siemens",
            2 => "Intel",
            3 => "Apple"
        );

        if ($fabricante === null)
            return $fabricantes;
        else {
            if (isset($fabricantes[$fabricante]))
                return $fabricantes[$fabricante];

            else
                return false;
        }
    }
}
