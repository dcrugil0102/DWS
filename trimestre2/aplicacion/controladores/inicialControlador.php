<?php

final class inicialControlador extends CControlador
{
	public array $menu = [];
	public array $menuizq = [];
	public array $barraUbi = [];
	public array $actual = [];

	public function __construct()
	{
		$this->menu = require __DIR__ . "/../config/menu.php";
	}

	public function accionIndex()
	{

		$this->menuizq = [
			[
				"texto" => "Inicio",
				"enlace" => ["inicial"]
			]
		];

		$this->barraUbi[] = $this->menu;
		$this->actual = $this->menu["inicio"];

		$this->dibujaVista(
			"index",
			[],
			"Pagina principal"
		);
	}
}
