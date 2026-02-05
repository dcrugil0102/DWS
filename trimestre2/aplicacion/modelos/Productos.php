<?php

class Productos extends CActiveRecord
{
    protected function fijarTabla(): string
    {
        return "productos";
    }
    protected function fijarNombre(): string
    {
        return "productos";
    }

    protected function fijarAtributos(): array
    {
        return array(
            "cod_producto",
            "nombre",
            "cod_categoría",
            "descripcion_categoria",
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
            "descripcion_categoria" => "Nombre de la categoría del producto",
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
                    "ATRI" => "nombre,cod_categoria",
                    "TIPO" => "REQUERIDO"
                ),
                array(
                    "ATRI" => "cod_producto",
                    "TIPO" => "ENTERO"
                ),
                array(
                    "ATRI" => "nombre",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 30
                ),
                array(
                    "ATRI" => "cod_categoria",
                    "TIPO" => "ENTERO"
                ),
                array(
                    "ATRI" => "cod_categoria",
                    "TIPO" => "FUNCION",
                    "FUNCION" => "validaCodCategoria"
                ),
                array(
                    "ATRI" => "fabricante",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 30,
                    "DEFECTO" => ""
                ),
                array(
                    "ATRI" => "fecha_alta",
                    "TIPO" => "FECHA"
                ),
                array(
                    "ATRI" => "unidades",
                    "TIPO" => "ENTERO",
                    "DEFECTO" => 0
                ),
                array(
                    "ATRI" => "precio_base",
                    "TIPO" => "REAL",
                    "DEFECTO" => 0,
                    "MIN" => 0
                ),
                array(
                    "ATRI" => "iva",
                    "TIPO" => "RANGO",
                    "RANGO" => [4, 10, 21],
                    "DEFECTO" => 21
                ),
                array(
                    "ATRI" => "precio_iva",
                    "TIPO" => "REAL"
                ),
                array(
                    "ATRI" => "precio_venta",
                    "TIPO" => "REAL"
                ),
                array(
                    "ATRI" => "foto",
                    "TIPO" => "CADENA",
                    "TAMANIO" => 40,
                    "DEFECTO" => "base.jpg"
                ),
                array(
                    "ATRI" => "borrado",
                    "TIPO" => "RANGO",
                    "RANGO" => [0, 1]
                ),

            );
    }

    public function afterCreate(): void
    {
        $this->fecha_alta = new DateTime();

        $precioBase = (float) $this->precio_base;
        $iva = (float) $this->iva;

        $this->precio_iva = ($precioBase * $iva) / 100;
        $this->precio_venta = $precioBase + $this->precio_iva;
        $this->borrado = 0;
    }

    public function validaCodCategoria()
    {
        $categoria = new Categorias();
        if (!$categoria->buscarPorId($this->cod_categoria)) {
            $this->setError("cod_categoria", "Categoría no válida");
        }
    }
}
