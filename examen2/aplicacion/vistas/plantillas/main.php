<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $titulo; ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/estilos/principal4.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

	<link rel="icon" type="image/png" href="/imagenes/favicon.png" />
	<?php
	if (isset($this->textoHead))
		echo $this->textoHead;
	?>
</head>

<body>
	<div id="todo">
		<header>
			<div class="logo-titulo">
				<div class="logo">
					<a href="/index.php"><img src="/imagenes/logo.png" width="50px" height="50px" /></a>
				</div>
				<div class="titulo">
					<a href="/index.php">
						<h1>PROYECTO FRAMEWORK PEDROSA</h1>
					</a>
				</div>
			</div>

		</header><!-- #header -->

		<nav id="menu">
			<ul>
				<?php
				$menu = $this->menu ?? [];

				foreach ($menu as $item) {
					echo CHTML::dibujaEtiqueta("li");

					$controlador = $item["enlace"][0];
					$accion = $item["enlace"][1];

					echo CHTML::link(
						$item["texto"],
						Sistema::app()->generaURL([$controlador, $accion])
					);

					echo CHTML::dibujaEtiquetaCierre("li");
				}
				?>
			</ul>
		</nav>




		<br>

		<nav id="barraUbi">
			<ul>
				<?php
				$nivel = $this->actual ?? null;
				$breadcrumb = [];

				while ($nivel) {
					array_unshift($breadcrumb, $nivel);
					$nivel = null;
					foreach ($this->barraUbi as $padre) {
						if (!empty($padre["hijos"])) {
							foreach ($padre["hijos"] as $hijo) {
								if ($hijo === $breadcrumb[0]) {
									$nivel = $padre;
									break 2;
								}
							}
						}
					}
				}

				array_unshift($breadcrumb, [
					'texto' => 'Inicio',
					'enlace' => ['inicial', 'index']
				]);

				$total = count($breadcrumb);
				foreach ($breadcrumb as $i => $item) {
					echo CHTML::dibujaEtiqueta("li");
					echo CHTML::link($item["texto"], Sistema::app()->generaURL($item["enlace"]));
					echo CHTML::dibujaEtiquetaCierre("li");

					if ($i < $total - 1) {
						echo '<i class="fa-solid fa-caret-right"></i>';
					}
				}

				?>
			</ul>
		</nav>


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

		<div id="pueblos">
			<p>Pueblos: <?= Sistema::app()->numeroPueblos() ?></p>
			<p>Reconocidos por la Unesco: <?= Sistema::app()->numeroPueblosUnesco() ?></p>

		<div>
			<?php
			if (Sistema::app()->Acceso()->hayUsuario()) {
				echo CHTML::dibujaEtiqueta("p", [], "Usuario: " . Sistema::app()->Acceso()->getNombre());
				echo CHTML::dibujaEtiquetaCierre("p");
			} else {
				echo CHTML::dibujaEtiqueta("p", [], "Usuario: Sin usuario");
				echo CHTML::dibujaEtiquetaCierre("p");
			}
			?>

		
			<button><?php echo CHTML::link("Desconectar", Sistema::app()->generaURL(["pueblos", "desconectar"])) ?></button>
			<button><?php echo CHTML::link("Conectar", Sistema::app()->generaURL(["pueblos", "conectar"])) ?></button>
		</div>

		</div>
		<footer>
			<h2><span>Copyright:</span> <?php echo Sistema::app()->autor ?> &copy;</h2>
		</footer><!-- #footer -->

	</div><!-- #wrapper -->
</body>

</html>