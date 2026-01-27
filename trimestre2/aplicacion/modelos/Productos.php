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
            "cod_producto"  => "Código identificador del producto",
            "nombre"        => "Nombre del producto",
            "cod_categoría" => "Código de la categoría del producto",
            "fabricante"    => "Empresa o marca fabricante",
            "fecha_alta"    => "Fecha de alta del producto en el sistema",
            "unidades"      => "Cantidad de unidades disponibles",
            "precio_base"   => "Precio del producto sin impuestos",
            "iva"           => "Porcentaje de IVA aplicado",
            "precio_iva"    => "Importe del IVA",
            "precio_venta"  => "Precio final con IVA incluido",
            "foto"          => "Imagen del producto",
            "borrado"       => "Indica si el producto está marcado como borrado"
        );
    }

    protected function fijarRestricciones(): array
    {
        return
            array(
                array(
                    "ATRI" => "cod_producto,nombre,cod_categoria",
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
