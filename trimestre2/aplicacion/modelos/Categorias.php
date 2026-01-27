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
            "cod_categoria" => "Código de la categoría",
            "descripcion" => "Descripción de la categoría"
        );
    }

    protected function fijarRestricciones(): array
    {
        return
            array(
                array(
                    "ATRI" => "cod_categoria,descripcion",
                    "TIPO" => "REQUERIDO"
                ),
                array(
                    "ATRI" => "cod_categoria",
                    "TIPO" => "ENTERO"
                ),
                array(
                    "ATRI" => "descripcion",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 40
                )

            );
    }

    public function dameCategorias($cod){

        $sentencia = "select descripcion from categorias";
        $consulta = Sistema::app()->BD()->crearConsulta($sentencia);
        $categorias = $consulta->filas();


        if (is_null($cod)) {
            return $categorias;
        } else {
            if (isset($categorias[$cod]))
                return $categorias[$cod];

            else
                return false;
        }
    }
}
