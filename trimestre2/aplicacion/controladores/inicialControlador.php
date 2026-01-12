<?php
	 
class inicialControlador extends CControlador
{
	public array $menuizq=[];
	public array $barraUbi=[];
	public function accionIndex()
	{
		

		$this->menuizq = [
			[
				"texto" => "Inicio", 
				"enlace" => ["inicial"]
			]
		];

		$this->barraUbi = [
			[
				"texto" => "Inicio", 
				"enlace" => ["inicial"]
			]
		];

		

		$this->dibujaVista("index",[],
							"Pagina principal");

							
	}

	
}
