<?php

$config = array(
	"CONTROLADOR" => array("inicial"),
	"RUTAS_INCLUDE" => array("aplicacion/modelos", "aplicacion/clases", "aplicacion/otros_elementos"),
	"URL_AMIGABLES" => true,
	"VARIABLES" => array(
		"autor" => "Damián Cruz Gil",
		"direccion" => "C/ Carrera - Madre Carmen, 12",
		"grupo" => "2daw"
	),
	"BD" => array(
		"hay" => false,
		"servidor" => "localhost",
		"usuario" => "root",
		"contra" => "root",
		"basedatos" => "practica10"
	),
	"sesion" => array("controlAutomatico" => true),

);
