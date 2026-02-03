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
	public function accionIndex()
	{
		$this->barraUbi = $this->menu;
		$this->actual = $this->menu["productos"];

		$producto = new Productos();

		$pag = intval($_GET['pag'] ?? 1);
		$reg_pag = intval($_GET['reg_pag'] ?? 5);
		$inicio = ($pag - 1) * $reg_pag;

		$opciones = ["where" => "cod_producto > $inicio", "limit" => $reg_pag];

		$order = "";

		if (!empty($_GET["orden"])) {
			$dir = ($_GET["dir"] ?? "asc") === "desc" ? "desc" : "asc";
			$order = $_GET["orden"] . " " . $dir;
		}

		$opciones["order"] = $order;

		$filas = $producto->buscarTodos($opciones);

		$total_reg = count(Sistema::app()->BD()->crearConsulta("select * from productos")->filas());

		foreach ($filas as $clave => $valor) {
			$filas[$clave]['fecha_alta'] = CGeneral::fechaMysqlANormal(
				$filas[$clave]["fecha_alta"]
			);

			$filas[$clave]['borrado'] = $filas[$clave]['borrado'] ? "SI" : "NO";

			// BOTONES **************

			$cadena = CHTML::link(
				CHTML::dibujaEtiqueta("i", ['class' => "fa-solid fa-eye"]) . CHTML::dibujaEtiquetaCierre("i"),
				Sistema::app()->generaURL(
					array("productos", "consultar"),
					array("id" => $filas[$clave]["cod_producto"])
				)
			);
			$cadena .= CHTML::link(
				CHTML::dibujaEtiqueta("i", ['class' => "fa-solid fa-pen-to-square"]) . CHTML::dibujaEtiquetaCierre("i"),
				Sistema::app()->generaURL(
					array("productos", "modificar"),
					array("id" => $filas[$clave]["cod_producto"])
				)
			);
			$cadena .= CHTML::link(
				CHTML::dibujaEtiqueta("i", ['class' => "fa-solid fa-trash"]) . CHTML::dibujaEtiquetaCierre("i"),
				Sistema::app()->generaURL(
					array("productos", "borrar"),
					array("id" => $filas[$clave]["cod_producto"])
				),
				array(
					"onclick" => "return
						confirm('&iquest;Esta seguro de borrar el producto?');"
				)
			);

			$filas[$clave]["opciones"] = $cadena;
		}



		$cabecera = array(
			array("CAMPO" => "nombre", "ETIQUETA" => "Nombre" . CHTML::link(
				CHTML::dibujaEtiqueta("i", ["class" => "fa fa-sort"]),
				Sistema::app()->generaURL(
					["productos", "index"],
					["orden" => "nombre", "dir" => isset($dir) ? ($dir !== "asc" ? "asc" : "desc") : "", "pag" => $pag, "reg_pag" => $reg_pag]
				)
			), "ALINEA" => "cen"),
			array("CAMPO" => "descripcion_categoria", "ETIQUETA" => "Categoría"  . CHTML::link(
				CHTML::dibujaEtiqueta("i", ["class" => "fa fa-sort"]),
				Sistema::app()->generaURL(
					["productos", "index"],
					["orden" => "descripcion_categoria", "dir" => isset($dir) ? ($dir !== "asc" ? "asc" : "desc") : ""]
				)
			), "ALINEA" => "cen"),
			array("CAMPO" => "fabricante", "ETIQUETA" => "Fabricante", "ALINEA" => "cen"),
			array("CAMPO" => "fecha_alta", "ETIQUETA" => "Fecha de alta", "ALINEA" => "cen"),
			array("CAMPO" => "unidades", "ETIQUETA" => "Unidades", "ALINEA" => "cen"),
			array("CAMPO" => "precio_base", "ETIQUETA" => "Precio base", "ALINEA" => "cen"),
			array("CAMPO" => "iva", "ETIQUETA" => "IVA (%)", "ALINEA" => "cen"),
			array("CAMPO" => "precio_iva", "ETIQUETA" => "Importe IVA", "ALINEA" => "cen"),
			array("CAMPO" => "precio_venta", "ETIQUETA" => "Precio final", "ALINEA" => "cen"),
			array("CAMPO" => "foto", "ETIQUETA" => "Foto", "ALINEA" => "cen"),
			array("CAMPO" => "borrado", "ETIQUETA" => "Borrado"  . CHTML::link(
				CHTML::dibujaEtiqueta("i", ["class" => "fa fa-sort"]),
				Sistema::app()->generaURL(
					["productos", "index"],
					["orden" => "borrado", "dir" => isset($dir) ? ($dir !== "asc" ? "asc" : "desc") : ""]
				)
			), "ALINEA" => "cen"),
			array("CAMPO" => "opciones", "ETIQUETA" => " Operaciones", "ALINEA" => "cen")
		);

		// CPAJAS ****************

		$opcPaginador = array(
			"URL" => Sistema::app()->generaURL(array("productos", "index")),
			"TOTAL_REGISTROS" => $total_reg,
			"PAGINA_ACTUAL" => $pag,
			"REGISTROS_PAGINA" => $reg_pag,
			"TAMANIOS_PAGINA" => array(
				5 => "5",
				10 => "10",
				20 => "20",
				30 => "30",
				40 => "40",
				50 => "50"
			),
			"MOSTRAR_TAMANIOS" => true,
			"PAGINAS_MOSTRADAS" => 7,
		);

		$this->dibujaVista(
			"indice",
			array(
				"filas" => $filas,
				"cabe" => $cabecera,
				"opcPag" => $opcPaginador
			),
			"Lista de Productos"
		);
	}
}
