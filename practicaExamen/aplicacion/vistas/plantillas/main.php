<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $titulo; ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/estilos/principal5.css" />

	<link rel="icon" type="image/png" href="/imagenes/favicon.png" />
	<?php
	if (isset($this->textoHead))
		echo $this->textoHead;
	?>
</head>

<body>
	<div id="todo">
		<header>
			<div class="logo">
				<a href="/index.php"><img src="/imagenes/logo.png" width="50px" height="50px" /></a>
			</div>
			<div class="titulo">
				<a href="/index.php">
					<h1>PROYECTO FRAMEWORK PEDROSA</h1>
				</a>
			</div>

		</header><!-- #header -->
		<div id="login">
			<?php
			if (Sistema::app()->Acceso()->hayUsuario()) {
				echo CHTML::dibujaEtiqueta("p");
				echo "Usuario: " . Sistema::app()->Acceso()->getNombre();
				echo CHTML::dibujaEtiquetaCierre("p");
			} else {
				echo CHTML::dibujaEtiqueta("p");
				echo "No hay usuario conectado";
				echo CHTML::dibujaEtiquetaCierre("p");
			}
			?>
			<div>
				<?php
				if (Sistema::app()->Acceso()->hayUsuario()) {
				?>
					<button><?php echo CHTML::link("Unlogin", Sistema::app()->generaURL(["partida", "logout"])) ?></button>
				<?php
				} else {
				?>
					<button><?php echo CHTML::link("Login", Sistema::app()->generaURL(["partida", "login"])) ?></button>
				<?php
				}
				?>
			</div>
		</div>
		<p id="Partidas"><?php echo "Numero de Partidas: " . Sistema::app()->numeroPartidas() . " Numero de Partidas de Hoy: " . Sistema::app()->numeroPartidasHoy() ?></p>

		<nav id="submenu">
			<ul><?php echo CHTML::link("Partida", Sistema::app()->generaURL(["partida", "ver"])); ?></ul>
			<ul><?php echo CHTML::link("Nueva Partida", Sistema::app()->generaURL(["partida", "nueva"])); ?></ul>
		</nav>
		<div class="barraMenu">
			<ul>
				<?php
				if (isset($this->menuhead)) {
					foreach ($this->menuhead as $opcion) {
						if ($opcion !== $this->menuhead[0]) {
							echo CHTML::dibujaEtiqueta("p");
							echo ">   ";
							echo " ";
							echo CHTML::dibujaEtiquetaCierre("p");
						}

						echo CHTML::dibujaEtiqueta(
							"li",
							array(),
							"",
							false
						);
						echo CHTML::css("padding", "40px");
						echo CHTML::link(
							$opcion["texto"],
							$opcion["enlace"]
						);
						echo CHTML::dibujaEtiquetaCierre("li");
						echo CHTML::dibujaEtiqueta("br") . "\r\n";
					}
				}

				?>
			</ul>
		</div>


		<div class="contenido">
			<aside>
				<ul>
					<?php
					if (isset($this->menuizq)) {
						foreach ($this->menuizq as $opcion) {
							echo CHTML::dibujaEtiqueta(
								"li",
								array(),
								"",
								false
							);
							echo CHTML::link(
								$opcion["texto"],
								$opcion["enlace"]
							);
							echo CHTML::dibujaEtiquetaCierre("li");
							echo CHTML::dibujaEtiqueta("br") . "\r\n";
						}
					}

					?>
				</ul>
			</aside>
			<article>
				<?php echo $contenido; ?>
			</article><!-- #content -->
			
		</div>
		<footer>
			<h2><span>Copyright:</span> <?php echo Sistema::app()->autor ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
		</footer><!-- #footer -->

	</div><!-- #wrapper -->
</body>

</html>