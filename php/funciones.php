<?php
require('conexion.php'); //Archivo que contiene la conexion a la bd

//funcion para realizar consultas y devolver una matriz con los datos
function consulta($consulta) {
	try {
		conectarBD();

		$manejadordb = $GLOBALS['conexion']->prepare($consulta);
		$manejadordb->execute();
		$matrizalerta = $manejadordb->fetchall();
		return $matrizalerta;
	} catch(PDOException $error) {
		echo "Error de base de datos: </br>", $error->getMessage(); 
	}
}

//funcion para insertar datos a partir de una consulta
function guardarDatos($consulta){
	try {
		conectarBD();

		$manejadordb = $GLOBALS['conexion']->prepare($consulta);
		$manejadordb->execute();
		return "Datos agregados correctamente";
	} catch(PDOException $error) {
		echo "Error de base de datos: </br>".$error->getMessage();
	}
	desconectarBD();

}

//funcion para insertar vehiculos
function insertar_vehiculo(){
	if (isset($_POST['marca'])){
		$datos['marca'] = $_POST['marca'];
		$datos['modelo'] = $_POST['modelo'];
		$datos['anio'] = $_POST['anio'];	
		$datos['patente'] = $_POST['patente'];

$consulta="INSERT INTO vehiculos(modelo, marca, anio, patente) VALUES ('".$datos['marca']."','".$datos['modelo']."',".$datos['anio'].",'".$datos['patente']."');";
		guardarDatos($consulta);
	}else{ 
echo "ingrese los datos";
	}
}



/* Para insertar:
"INSERT INTO tabla(campoA, campoB) VALUES(".$numero.", '".$texto."');";

Para hacer un update:
"UPDATE tabla SET campoA = ".$numero.", campoB = '".$texto."' WHERE id_tabla = ".$id.";
*/

//--------------------------Cargar combobox---------------------------------
function cargar_combo($matrizItems, $campo, $id) {
	//Carga un combobox a partir de una matriz de items
	foreach($matrizItems as $registro) {
		echo "<option value='$registro[$id]'>".$registro[$campo]."</option>";
	}
}
?>