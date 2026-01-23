<?php
echo CHTML::dibujaEtiqueta('h2', [], 'Datos de Registro');
echo CHTML::dibujaEtiquetaCierre('h2');

// Nick
echo CHTML::dibujaEtiqueta('strong', [], 'Nick: ');
echo $modelo->nick;
echo CHTML::dibujaEtiqueta('br');
echo CHTML::dibujaEtiqueta('br');

// NIF
echo CHTML::dibujaEtiqueta('strong', [], 'NIF: ');
echo $modelo->nif;
echo CHTML::dibujaEtiqueta('br');
echo CHTML::dibujaEtiqueta('br');

// Fecha de nacimiento
echo CHTML::dibujaEtiqueta('strong', [], 'Fecha de nacimiento: ');
echo $modelo->fecha_nacimiento;
echo CHTML::dibujaEtiqueta('br');
echo CHTML::dibujaEtiqueta('br');

// Provincia
echo CHTML::dibujaEtiqueta('strong', [], 'Provincia: ');
echo $modelo->provincia;
echo CHTML::dibujaEtiqueta('br');
echo CHTML::dibujaEtiqueta('br');

// Estado
echo CHTML::dibujaEtiqueta('strong', [], 'Estado: ');
echo DatosRegistro::dameEstados($modelo->estado);
echo CHTML::dibujaEtiqueta('br');
echo CHTML::dibujaEtiqueta('br');

// Contraseña (asteriscos)
echo CHTML::dibujaEtiqueta('strong', [], 'Contraseña: ');
echo str_repeat('*', strlen($modelo->contrasenia));
echo CHTML::dibujaEtiqueta('br');
echo CHTML::dibujaEtiqueta('br');
