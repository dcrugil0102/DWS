<?php
	 
class usuariosControlador extends CControlador
{
	public array $menuizq=[];
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

    public function accionNuevo(){
        echo "Agregar usuario";
    }
    public function accionModificar(){
        echo "Modificar usuario";
    }
    public function accionBorrar(){
        $this->dibujaVista('prueba', [], "Borrar usuario");
    }

	
}
