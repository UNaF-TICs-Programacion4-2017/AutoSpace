<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function mostrar(elemento){
			document.getElementById(elemento).style.display = 'block';
		}

		function ocultar(){
			document.getElementById('oculto').style.display = 'none';
		}
	</script>
</head>
<body>
<input type="button" value="Mostrar" onclick="mostrar('oculto')">
<div id='oculto' style='display:none;'>
Contenido a ocultar, puede ser bloques de texto, imágenes, videos o cualquier otro elemento.
</div> 
</body>
</html>