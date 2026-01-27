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
		$this->menuizq = $this->menu['inicial']['hijos'];

		session_start();
	}

	public function accionIndex()
	{


		$this->dibujaVista(
			"index",
			[],
			"Pagina principal"
		);
	}
}
