<?php

class usuariosControlador extends CControlador
{
	public array $menuizq = [];
	public function __construct() {}
	public function accionIndex()
	{


		$this->menuizq = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			]
		];
		echo "Listado de todos los usuarios existentes";
	}

	public function accionNuevo()
	{
		echo "Nuevo Usuario";
	}
	public function accionModificar()
	{
		echo "Modificar Usuario";
	}
	public function accionBorrar()
	{
		echo "Borrar usuario";
		$this->dibujaVista(
			"prueba",
			[],
			"Borrar Usuario"
		);
	}
}
