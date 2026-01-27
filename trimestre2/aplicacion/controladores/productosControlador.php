<?php

final class productosControlador extends CControlador
{

	public array $menu = [];
	public array $menuizq = [];
	public array $barraUbi = [];
	public array $actual = [];

	public function __construct()
	{
		$this->menu = require __DIR__ . "/../config/menu.php";
		$this->menuizq = $this->menu['productos']['hijos'];

		session_start();
	}
    public function accionIndex(){
        $this->barraUbi = $this->menu;
		$this->actual = $this->menu["productos"];

        $this->dibujaVista("index", [], "Productos");
    }
}