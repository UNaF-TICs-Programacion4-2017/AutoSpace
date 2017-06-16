<?php
//conexion a la base de datos
constant('NOMBREDB') = "autospace"
$conexion = null;

function conectarBD() { 
	try {
		$GLOBALS['conexion'] = new PDO('mysql:host=localhost;dbname='.NOMBREDB, 'root', '');
	} catch(PDOException $error) {
		echo "Error de base de datos: </br>", $error->getMessage();
	}
}
?>