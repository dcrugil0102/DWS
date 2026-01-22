<?php

class DatosRegistro extends CActiveRecord
{
    protected function fijarNombre()
 {

 }

 protected function fijarAtributos()
 {
 return array("cod_articulo","descripcion",
 "nombre","cod_fabricante",
 "fabricante_nombre","fecha_alta");
 }

 protected function fijarDescripciones()
 {
 return array("fecha_alta"=>"Fecha de alta",

 "cod_fabricante"=>"Fabricante",
 "nombre_fabricante"=>"Fabricante");
 }

 protected function fijarRestricciones()
 {
 Return
 array(array("ATRI"=>"cod_articulo,nombre",
 "TIPO"=>"REQUERIDO"),
 array("ATRI"=>"cod_articulo","TIPO"=>"ENTERO",
 "MIN"=>0),
 array("ATRI"=>"nombre","TIPO"=>"CADENA",
 "TAMANIO"=>30),
 array("ATRI"=>"descripcion",
 "TIPO"=>"CADENA", "TAMANIO"=>60),
 array("ATRI"=>"cod_fabricante","TIPO"=>"ENTERO",
 "MIN"=>0),
 array("ATRI"=>"fecha_alta", "TIPO"=>"FECHA"),
 array("ATRI"=>"fecha_alta",
 "TIPO"=>"FUNCION",
 "FUNCION"=>"validaFechaAlta"),
 );
 }

 protected function afterCreate()
 {
 $this->cod_articulo=0;
 $this->nombre="";
 $this->descripcion="";
 $this->cod_fabricante=1;
 $this->fabricante_nombre="SIN INDICAR";
 }

 public function validaFechaAlta()
 {
 $fecha1=DateTime::createFromFormat('d/m/Y',
 $this->fecha_alta);
 $fecha2=DateTime::createFromFormat('d/m/Y',
 '01/01/2000');
 if ($fecha1<$fecha2)
 {
 $this->setError("fecha_alta",
 "La fecha de alta debe ser posterior a
01/01/2000");
 }
 }

 public static function listaFabricantes($fabricante=null)
 {
 $fabricantes=array(1=>"Siemens",
 2=>"Intel",
 3=>"Apple");

 if ($fabricante===null)
 return $fabricantes;
 else
 {
 if (isset($fabricantes[$fabricante]))
 return $fabricantes[$fabricante];

 else
 return false;
 }
 }

}
