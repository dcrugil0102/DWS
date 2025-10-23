<?php
final class Flauta extends InstrumentoViento implements IFabricante
{
    private function __construct($material, $edad)
    {
        parent::__construct($material, $edad);
    }
    static function crearDesdeArray($datos)
    {
        $material = $datos['material'] ?? 'madera';
        $edad = $datos['edad'] ?? 15;

        return new Flauta($material, $edad);
    }

    function clonacion()
    {
        return $nuevaFlauta = new Flauta($this->_material, 0);
    }

    function metodoFabricacion()
    {
        return "1. Consigue un tubo de madera o bambú de unos 30 cm de largo.\n2. Lija los bordes para que queden suaves.\n3. Marca los puntos donde irán los agujeros con un lápiz.\n4. Taladra cuidadosamente los agujeros según el tono que quieras.\n5. Haz una pequeña ranura cerca del extremo superior para soplar.\n6. Prueba el sonido y ajusta los agujeros si es necesario.\n7. Lija de nuevo y aplica barniz o aceite para proteger la madera.\n8. Deja secar y ¡ya tienes tu flauta lista para tocar!";
    }
    function metodoReciclado()
    {
        switch ($this->_material) {
            case "madera":
                return "La flauta de madera se recicla triturándola para fabricar tableros o pellets.";
            case "metal":
                return "La flauta metálica se funde para reutilizar el metal en nuevos productos.";
            case "plastico":
                return "La flauta de plástico se recicla triturándola para crear nuevos objetos plásticos.";
            default:
                return "Material desconocido. No se puede determinar el método de reciclado.";
        }
    }
}
