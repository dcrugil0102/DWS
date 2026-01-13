<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $titulo; ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/estilos/principal3.css" />
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
			<div class="logo">
				<a href="/index.php"><img src="/imagenes/logo.png" width="50px" height="50px" /></a>
			</div>
			<div class="titulo">
				<a href="/index.php">
					<h1>PROYECTO FRAMEWORK PEDROSA</h1>
				</a>
			</div>

		</header><!-- #header -->

		<nav id="menu">
				<ul>


					<?php 
					
					if (isset($this->ejercicios)) {
						foreach ($this->ejercicios as $practica => $opciones) {
							echo CHTML::dibujaEtiqueta("li");
							echo CHTML::link($opciones['titulo'], Sistema::app()->generaURL([$practica, $opciones['vista']]));

							if (isset($opciones['ejercicios'])) {
								echo CHTML::dibujaEtiqueta("ul");

								foreach ($opciones['ejercicios'] as $ejercicio => $titulo) {
									echo CHTML::dibujaEtiqueta("li");
									echo CHTML::link($titulo, Sistema::app()->generaURL([$practica, $ejercicio]));
									echo CHTML::dibujaEtiquetaCierre("li");
								}

								echo CHTML::dibujaEtiquetaCierre("ul");
							}

							echo CHTML::dibujaEtiquetaCierre("li");
						}
					}

					?>
					
				</ul>
		</nav>

		<br>

		<nav id="barraUbi">
			<ul>
					<?php

					if (isset($this->barraUbi)) {
						foreach ($this->barraUbi as $opcion) {

							if ($opcion !== $this->barraUbi[0]) {
								echo CHTML::dibujaEtiqueta("p");
								echo "<i class='fa-solid fa-caret-right'></i>";
								echo CHTML::dibujaEtiquetaCierre("p");
							}

							echo CHTML::dibujaEtiqueta("li");
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
			<h2><span>Copyright:</span> <?php echo Sistema::app()->autor ?> </h2>
		</footer><!-- #footer -->

	</div><!-- #wrapper -->
</body>

</html>