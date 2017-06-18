<!DOCTYPE html>
<html>
<head>
	<title>Reservas</title>
	<link rel="stylesheet" type="text/css" href="../css/formularios.css" media="screen"/>

	<!--funciones para esconder o mostrar un elemento-->
	<script type="text/javascript" src="../js/ocultar.js"></script>

</head>
<body>
	<div class="formulario">
	<form action="" method="post">
			<table>
			<tr>
			<!--Hora de inicio de la reserva-->
				<td>Hora: </td>
				<td><input type="text" name="horareserva"/></td>
			</tr>
			<tr>
			<!--Seleccionar el tipo de reserva (por dia y reserva diaria por periodo)-->
				<td>Tipo de reserva: </td>
				<td><input type="radio" name="tiporeserva" value="dia" onclick ="ocultar('periodo'); mostrar('dia');" checked /> S&oacute;lo por el d&iacute;a
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="tiporeserva" onclick="mostrar('periodo'); ocultar('dia');" value="periodo" /> Por peri&oacute;do</td> 
			</tr>
		</table>
		<table id="dia">
			<tr>
			<!--Fecha de reserva (Solo si no se selecciona por periodo-->
				<td>Fecha:</td>
				<td> <input type="text" name="fechareserva"/></td>
			</tr>
		</table>
		<table id="periodo" style="display:none;">	<!--Esta seccion aparece solo si seleccionamos por periodo-->
			<tr>
				<td>Seleccionar dias: </td>
				<td>
					<input type="checkbox" name="lunes"/>Lunes &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="martes"	/>Martes &nbsp;&nbsp;&nbsp;&nbsp;</br>
					<input type="checkbox" name="miercoles" />Mi&eacute;rcoles &nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="jueves" />Jueves &nbsp;&nbsp;&nbsp;&nbsp;</br>
				<input type="checkbox" name="viernes"/>Viernes &nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="sabado"/>S&aacute;bado &nbsp;&nbsp;&nbsp;&nbsp;</br>
				<input type="checkbox" name="domingo"/>Domingo &nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		</table>
		<div class="botonera">
		<input type="submit" class="boton" value="Verificar Reserva" style="top: 200;"/>
		</div>
	</form>
	</div>
</body>
</html>