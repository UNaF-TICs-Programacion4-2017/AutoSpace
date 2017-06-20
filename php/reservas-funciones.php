<?php
require('funciones.php');

//-------------------------Funciones de Modulo Reservas---------------------------
function cargar_horarios() {
	
	echo "<tr><td>00:00</td></tr>";
	echo "<tr><td>01:00</td></tr>";
	echo "<tr><td>02:00</td></tr>";
	echo "<tr><td>03:00</td></tr>";
	echo "<tr><td>04:00</td></tr>";
	echo "<tr><td>05:00</td></tr>";
	echo "<tr><td>06:00</td></tr>";
	echo "<tr><td>07:00</td></tr>";
	echo "<tr><td>08:00</td></tr>";
	echo "<tr><td>09:00</td></tr>";
	echo "<tr><td>10:00</td></tr>";
	echo "<tr><td>11:00</td></tr>";
	echo "<tr><td>12:00</td></tr>";
	echo "<tr><td>13:00</td></tr>";
	echo "<tr><td>14:00</td></tr>";
	echo "<tr><td>15:00</td></tr>";
	echo "<tr><td>16:00</td></tr>";
	echo "<tr><td>17:00</td></tr>";
	echo "<tr><td>18:00</td></tr>";
	echo "<tr><td>19:00</td></tr>";
	echo "<tr><td>20:00</td></tr>";
	echo "<tr><td>21:00</td></tr>";
	echo "<tr><td>22:00</td></tr>";
	echo "<tr><td>23:00</td></tr>";

}
function verificar_disponibilidad($horareserva, $horafin) {
	
	$estacionamiento = $_POST['estacionamiento'];
	$estado = "ocupado";
	$consulta = "SELECT count(rela_puesto) as libres, fecha_reserva, hora_reserva, hora_fin, estado FROM reservas INNER JOIN puestos ON id_puesto = rela_puesto INNER JOIN estacionamiento ON id_estacionamiento = rela_estacionamiento WHERE rela_estacionamiento = ".$estacionamiento." AND fecha_reserva = '".$fecha_actual."' AND hora_reserva >= '".$horareserva."' AND hora_fin <= '".$horafin."' OR hora_fin > '".$horafin."' GROUP BY estado";

	$matriz = consulta($consulta);

	foreach($matriz as $puestos) {
		if($puestos['estado'] == 0) {
			$estado = "libre"; 
		}
	}
}

//----------------------Obtener las fechas-----------------------------------
function obtener_fechas() {
//funcion para obtener la lista de fechas de la semana
	$fecha_actual = date("Y-m-d");
	$dias = array('domingo','lunes','martes','miercoles','jueves','viernes','sabado');
	$fecha = $dias[date('N', strtotime($fecha_actual))];
	//Declarar array para guardar las fechas de la semana
	$arrayFechas['lunes'] = null;
	$arrayFechas['martes'] = null;
	$arrayFechas['miercoles'] = null;
	$arrayFechas['jueves'] = null;
	$arrayFechas['viernes'] = null;
	$arrayFechas['sabado'] = null;
	$arrayFechas['domingo'] = null;
	echo $arrayFechas['lunes'];
	//asignar fechas
	switch($fecha) {
		case "lunes":
			$arrayFechas['lunes'] = $fecha_actual;
			$arrayFechas['martes'] = sumar_fechas($fecha_actual, 1);
			$arrayFechas['miercoles'] = sumar_fechas($fecha_actual, 2);
			$arrayFechas['jueves'] = sumar_fechas($fecha_actual, 3);
			$arrayFechas['viernes'] = sumar_fechas($fecha_actual, 4);
			$arrayFechas['sabado'] = sumar_fechas($fecha_actual, 5);
			$arrayFechas['domingo'] = sumar_fechas($fecha_actual, 6);
			break;
		case "martes":
			$arrayFechas['lunes'] = restar_fechas($fecha_actual, 1);
			$arrayFechas['martes'] = $fecha_actual;
			$arrayFechas['miercoles'] = sumar_fechas($fecha_actual, 1);
			$arrayFechas['jueves'] = sumar_fechas($fecha_actual, 2);
			$arrayFechas['viernes'] = sumar_fechas($fecha_actual, 3);
			$arrayFechas['sabado'] = sumar_fechas($fecha_actual, 4);
			$arrayFechas['domingo'] = sumar_fechas($fecha_actual, 5);
			break;
		case "miercoles":
			$arrayFechas['lunes'] = restar_fechas($fecha_actual, 2);
			$arrayFechas['martes'] = restar_fechas($fecha_actual, 1);
			$arrayFechas['miercoles'] = $fecha_actual;
			$arrayFechas['jueves'] = sumar_fechas($fecha_actual, 1);
			$arrayFechas['viernes'] = sumar_fechas($fecha_actual, 2);
			$arrayFechas['sabado'] = sumar_fechas($fecha_actual, 3);
			$arrayFechas['domingo'] = sumar_fechas($fecha_actual, 4);
			break;
		case "jueves":
			$arrayFechas['lunes'] = restar_fechas($fecha_actual, 3);
			$arrayFechas['martes'] = restar_fechas($fecha_actual, 2);
			$arrayFechas['miercoles'] = restar_fechas($fecha_actual, 1);
			$arrayFechas['jueves'] = $fecha_actual;
			$arrayFechas['viernes'] = sumar_fechas($fecha_actual, 1);
			$arrayFechas['sabado'] = sumar_fechas($fecha_actual, 2);
			$arrayFechas['domingo'] = sumar_fechas($fecha_actual, 3);
			break;
		case "viernes":
			$arrayFechas['lunes'] = restar_fechas($fecha_actual, 4);
			$arrayFechas['martes'] = restar_fechas($fecha_actual, 3);
			$arrayFechas['miercoles'] = restar_fechas($fecha_actual, 2);
			$arrayFechas['jueves'] = restar_fechas($fecha_actual, 1);
			$arrayFechas['viernes'] = $fecha_actual;
			$arrayFechas['sabado'] = sumar_fechas($fecha_actual, 1);
			$arrayFechas['domingo'] = sumar_fechas($fecha_actual, 2);
			break;
		case "sabado":
			$arrayFechas['lunes'] = restar_fechas($fecha_actual, 5);
			$arrayFechas['martes'] = restar_fechas($fecha_actual, 4);
			$arrayFechas['miercoles'] = restar_fechas($fecha_actual, 3);
			$arrayFechas['jueves'] = restar_fechas($fecha_actual, 2);
			$arrayFechas['viernes'] = restar_fechas($fecha_actual, 1);
			$arrayFechas['sabado'] = $fecha_actual;
			$arrayFechas['domingo'] = sumar_fechas($fecha_actual, 1);
			break;
		case "domingo":
			$arrayFechas['lunes'] = restar_fechas($fecha_actual, 6);
			$arrayFechas['martes'] = restar_fechas($fecha_actual, 5);
			$arrayFechas['miercoles'] = restar_fechas($fecha_actual, 4);
			$arrayFechas['jueves'] = restar_fechas($fecha_actual, 3);
			$arrayFechas['viernes'] = restar_fechas($fecha_actual, 2);
			$arrayFechas['sabado'] = restar_fechas($fecha_actual, 1);
			$arrayFechas['domingo'] = $fecha_actual;
			break;
	}
	return $arrayFechas;
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
?>