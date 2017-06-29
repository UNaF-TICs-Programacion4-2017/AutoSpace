<?php
require('conexion.php'); //Archivo que contiene la conexion a la bd

date_default_timezone_set('America/Argentina/Buenos_Aires'); //establece la zona horaria de las funciones hora/fecha

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

//funcion que valida una fecha formato Y-m-d
function validar_fecha($fecha) {
	$partes = explode ("-", $fecha);
	if(count($partes) == 3) {
		if(checkdate($partes[1], $partes[2], $partes[0])){
			return true;
		} else {
		return false;
		}
	} else {
		return false;
	}
}

//----------SUMA DE FECHAS-----------------
function sumar_fechas($fecha, $cantidad) {
	//funcion para sumar dias
	$fecha_suma = strtotime($fecha."+ ".$cantidad." days");
	return date("Y-m-d", $fecha_suma);
}

function restar_fechas($fecha, $cantidad) {
	//funcion para sumar dias
	$fecha_suma = strtotime($fecha."- ".$cantidad." days");
	return date("Y-m-d", $fecha_suma);
}

//funcion que valida una hora en formato h:i (ej: 09:00)
function validar_hora($hora) {
	$partes = explode(":", $hora);
	$valido = false;
	$i = 0;
	if(count($partes) == 2 or count($partes) == 3) {
		foreach($partes as $valor){
			$i++;
			if ($i==0) {
				if (is_numeric($valor) && $valor >=0 && $valor <=23){
					$valido = true; 
				} else {
					return false;
					exit;
				}
			} else {
				if (is_numeric($valor) && $valor >=0 && $valor <=59){
						$valido = true; 
				} else {
					return false;
					exit;
				}
			}
		}
	} else {
		return false;
	}
	return $valido;
}

//funcion para mostrar un mensaje de javascript
function msj_script($mensaje){
	echo "<script>alert('".$mensaje."')</script>";
}

//funcion para obtener los datos del usuario, de acuerdo a un campo
function obtener_datos_usuario($campo) {
	if (isset($_SESSION['usuario'])) {
		$usuario = $_SESSION['usuario'];
		$consulta = "SELECT ".$campo." FROM usuarios INNER JOIN personas ON id_persona = rela_persona where nombre_usuario like '".$usuario."';";
		$dato = consulta($consulta);
		return $dato[0][$campo];
	} else {
		return "No se ha ingresado";
	}
}

function insertar_usuario(){
    	$usuario=$_POST['usuario'];
    
    	$consulta ="SELECT count(*) as cantidad, nombre_usuario FROM usuarios INNER JOIN perfiles ON id_perfil=rela_perfil WHERE nombre_usuario ='".$usuario."';";

        $matrizconsulta = consulta($consulta);
    
    	if($matrizconsulta[0]['cantidad'] > 0) {
        	echo "<script>alert('Nombre de usuario ya existente')</script>";   
    	} else{

			if (isset($_POST['nombre'])){
				$datos['nombre'] = $_POST['nombre'];
				$datos['usuario'] = $_POST['usuario'];
				$datos['dni'] = $_POST['dni'];
				$datos['telefono'] = $_POST['telefono'];
				$datos['apellido'] = $_POST['apellido'];
				$datos['domicilio'] = $_POST['domicilio'];
				$datos['pass'] = $_POST['pass'];
				
					
		
		$consulta = "INSERT INTO personas (nombre_persona, apellido, dni, domicilio, telefono) VALUES('".$datos['nombre']."', '".$datos['apellido']."', '".$datos['dni']."', '".$datos['domicilio']."', '".$datos['telefono']."');";

			guardarDatos($consulta);

		$consulta = "INSERT INTO usuarios (rela_persona, nombre_usuario, pass, rela_perfil) VALUES(1, '".$datos['usuario']."', '".$datos['pass']."',1);";
		
		guardarDatos($consulta);
		msj_script('Usuario Registrado correctamente');
		echo "<script type='text/javascript'>top.location.href = '../index.php';</script>";
			}
		}
}

function validacion_registro_usuario(){
	if (!(isset($_POST['usuario'])) or strlen($_POST['usuario']) <= 0) {
		echo "<script>alert('Ingrese un nombre de usuario');</script>";
	} elseif(!(isset($_POST['pass'])) or strlen($_POST['pass']) <= 0) {
		echo "<script>alert('Ingrese la contraseña');</script>";
	} elseif($_POST['pass'] <> $_POST['repass']) {
		echo "<script>alert('Las contraseñas no coinciden');</script>";
	} elseif($_POST['pass'] <> $_POST['repass']) {
		echo "<script>alert('Las contraseñas no coinciden');</script>";
	} elseif(!(isset($_POST['nombre'])) or strlen($_POST['nombre']) <= 0) {
		echo "<script>alert('Ingrese el nombre');</script>";
	} elseif(!(isset($_POST['apellido'])) or strlen($_POST['apellido']) <= 0) {
		echo "<script>alert('Ingrese el apellido');</script>";
	} elseif(!(isset($_POST['dni'])) or strlen($_POST['dni']) <= 0) {
		echo "<script>alert('Ingrese el dni');</script>";
	} else {
		insertar_usuario();
	}
}

function mostrardatos(){
conectarBD();
		$consulta="SELECT * FROM vehiculos;";

		$manejadordb = $GLOBALS['conexion']->prepare($consulta);
		$manejadordb->execute();
		$matrizalerta2 = $manejadordb->fetchall();

		foreach($matrizalerta2 as $registro) {
		//	
			echo "<tr><td>".$registro['id_vehiculo']."</td>";
			echo "<td>".$registro['marca']."</td>";
			echo "<td>".$registro['modelo']."</td>";
			echo "<td>". $registro['anio'] ."</td>";
			echo "<td>". $registro['patente'] ."</td>";
			echo '<td width=240>';

                echo "<a data-toggle='modal' data-target='#editUsu' data-id='" .$registro['id_vehiculo'] ."' data-marca='" .$registro['marca'] ."' data-modelo='" .$registro['modelo'] ."'  data-anio='" .$registro['anio'] ."' data-patente='" .$registro['patente'] ."' class='btn btn-warning'><span class='glyphicon glyphicon-pencil'></span>Editar</a> ";			
					
                echo ' ';
                echo "<a class='btn btn-danger' href='php/elimina.php?id=" .$registro['id_vehiculo'] ."'><span class='glyphicon glyphicon-remove'></span>Eliminar</a>";		
				echo '</td>';

 }
}



?>