<!DOCTYPE html>
<html>
<head>
	<title>Reservas</title>
	<script type="text/javascript">
	function mostrar(elemento){
		document.getElementById(elemento).style.display = 'block';
	}

	function ocultar(elemento){
		document.getElementById(elemento).style.display = 'none';
	}
	</script>
</head>
<body>
	<form action="" method="post">
		<table>
		<tr>
			<td>Fecha:</td>
			<td> <input type="text" name="fechareserva"/></td>
		</tr>
		<tr>
			<td>Hora: </td>
			<td><input type="text" name="horareserva"/></td>
		</tr>
		<tr>
			<td>Tipo de reserva: </td>
			<td><input type="radio" name="tiporeserva" value="dia" onclick ="ocultar('periodo')" checked /> S&oacute;lo por el d&iacute;a
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="tiporeserva" onclick="mostrar('periodo')" value="periodo" /> Por peri&oacute;do</td>
			<input type="button" value="Mostrar" onclick="mostrar('periodo')"> 
		</tr>
		<tr>
			
			<td>Seleccionar dias: </td>
			<td>
			<div name="periodo" style="display:none;">
			<input type="checkbox" name="lunes"/>Lunes &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="martes"	/>Martes &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="miercoles" />Mi&eacute;rcoles &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="jueves" />Jueves &nbsp;&nbsp;&nbsp;&nbsp;</br>
			<input type="checkbox" name="viernes"/>Viernes &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="sabado"/>S&aacute;bado &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="domingo"/>Domingo &nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			</td>
		</tr>
		</table>
	</form>
</body>
</html>