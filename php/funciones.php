<?php
constant('NOMBREDB') = "autospace"
//conexion a la base de datos
try {
	$conexion = new PDO('mysql:host=localhost;dbname='.NOMBREDB, 'root', '');
} catch(PDOException $error) {
	echo "Error de base de datos: </br>", $error->getMessage();
}

//funcion para realizar consultas y devolver una matriz con los datos
function consulta($consulta, $conexion) {
try {
	$manejadordb = $conexion->prepare($consulta);
	$manejadordb->execute();
	$matrizalerta = $manejadordb->fetchall();
	return $matrizalerta;
} catch(PDOException $error) {
	echo "Error de base de datos: </br>", $error->getMessage(); 
}
}

//funcion para insertar datos a partir de una consulta
function insertar($consulta, $conexion){
	try {
		$manejadordb = $conexion->prepare($consulta);
		$manejadordb->execute();
		return "Datos agregados correctamente";
	} catch(PDOException $error) {
		echo "Error de base de datos: </br>", $error->getMessage();
	}
}


?>