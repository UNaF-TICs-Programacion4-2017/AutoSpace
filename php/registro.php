<!DOCTYPE html>
<html>
<head>
	<title>Reservas</title>
	<link rel="stylesheet" type="text/css" href="../css/formularios.css" media="screen"/>

	<!--funciones para esconder o mostrar un elemento-->
	<script type="text/javascript" src="../js/ocultar.js"></script>

</head>
<?php
require('../php/funciones.php');
?>
<body>
	<div class="formulario">
	<!--Enlace a tabla de horarios disponibles y ocupados-->
	<div id="enlace" style="width: 170px; height: 25px; margin: 0 auto;">
	<a href="../index.php#horarios" target="_parent">Ver horarios disponibles</a></div>
	
	<form action="" method="post">
			<table>
			<tr>
				<td>Nombres</td>
				<td><input type="text" name="nombre" placeholder="ing. Nombre" /></td>
			</tr>
			<tr>
				<td>Apellidos</td>
				<td><input type="text" name="apellido" placeholder="ingrese apellidos" /></td>
			</tr>
			<tr>
				<td>DNI</td>
				<td><input type="text" name="dni" placeholder="ingrese DNI" /></td>
			</tr>
			<tr>
				<td>Domicilio</td>
				<td><input type="text" name="domicilio" placeholder="ing. domicilio" /></td>
			</tr>
			<tr>
				<td>Telefono</td>
				<td><input type="text" name="tel" placeholder="ing. telefono o celular" /></td>
			</tr>
			<tr>
				<input type="submit" name="registrando">
			</tr>
		
		</table>
		<div class="botonera">
		<input type="submit" class="boton" value="Verificar Reserva"/>
		<input type="reset" class="boton" value="Limpiar"/>
		</div>
	</form>
	</div>
</body>
</html>