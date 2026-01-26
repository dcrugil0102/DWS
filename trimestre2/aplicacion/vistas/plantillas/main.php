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

			<div class="user">
				<p></p>
				<?php
				if (!isset($_SESSION['login'])) {
					echo CHTML::dibujaEtiqueta("p", [], "Usuario: no conectado");
					echo CHTML::botonHtml(CHTML::link("Login", Sistema::app()->generaURL(["registro", "login"])));
					echo CHTML::botonHtml(CHTML::link("Registrarse", Sistema::app()->generaURL(["registro", "pedirDatosRegistro"])));
				} else {
					echo CHTML::dibujaEtiqueta("p", [], "Usuario: " . $_SESSION['login']->nick);
					echo CHTML::dibujaEtiquetaCierre("p");
					echo CHTML::botonHtml(CHTML::link("Logout", Sistema::app()->generaURL(["registro", "logout"])));
				}
				?>
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
		<footer>
			<h2><span>Copyright:</span> <?php echo Sistema::app()->autor ?> &copy;</h2>
		</footer><!-- #footer -->

	</div><!-- #wrapper -->
</body>

</html>