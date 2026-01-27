<?php

class Login extends CActiveRecord
{
    protected function fijarNombre(): string
    {
        return 'Productos';
    }

    protected function fijarAtributos(): array
    {
        return array(
            "cod_producto",
            "nombre",
            "cod_categoría",
            "fabricante",
            "fecha_alta",
            "unidades",
            "precio_base",
            "iva",
            "precio_iva",
            "precio_venta",
            "foto",
            "borrado"
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

        $sentencia = "select descripcion from categorias where cod_categoria = $cod";
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
