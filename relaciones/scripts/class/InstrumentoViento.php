<?php
class InstrumentoViento extends InstrumentoBase
{

    // VARIABLES ***************

    protected $_material = "madera";

    // CONSTRUCTOR ****************

    function __construct($material, $edad = 15)
    {
        parent::__construct($edad);
        $this->_material = $material;
    }

    // MÉTODOS ********************

    final function afinar()
    {
        return "1. Calienta el instrumento tocando unos minutos.\n2. Usa un afinador o una nota de referencia.\n3. Toca la nota base (normalmente un La).\n4. Si suena aguda, saca un poco la boquilla o el tubo.\n5. Si suena grave, métela un poco.\n6. Comprueba el resto de notas y ajusta si hace falta.";
    }

    function sonido()
    {
        return "Suena como un “fuuuu” suave y controlado que vibra al pasar por el instrumento.";
    }

    function __toString()
    {
        return "Instrumento de material $_material";
    }
}
