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
			
		
		</table>
		<input type="submit" name="registrando">
		<div class="botonera">
		<input type="submit" class="boton" value="registrar"/>
		<input type="reset" class="boton" value="Limpiar"/>
		</div>
	</form>
	</div>
</body>
</html>