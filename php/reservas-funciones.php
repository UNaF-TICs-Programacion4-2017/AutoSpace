<?php
require('funciones.php');

//-------------------------Funciones de Modulo Reservas---------------------------
function cargar_horarios() {
	
	$FechasSemana = obtener_fechas();	//en este array guardo las fechas de la semana vigente segun la fecha actual
	$horaSig = 0;
	for($i = 0; $i < 24; $i++) {
		$hora = $i.":00";
		$horaSig = intval($i + 1);
		$horaFinal = $horaSig.":00";
		echo "<tr><td>".$hora."</td>";
		
		foreach($FechasSemana as $dia=>$valor) {
			//Recorro la matriz fechasSemana y le mando un verificar a ese horario
			$matrizEstados = null;
			$matrizEstados = verificar_disponibilidad($hora, $horaFinal, $valor);
			echo "<td><p fontcolor='green'>Libres: ".$matrizEstados['libres']."</p></br>";
			echo "<p fontcolor='brown'>Reservados: ".$matrizEstados['ocupados']."</p></br>";
			echo "<p fontcolor='red'>Ocupados: ".$matrizEstados['ocupados']."</p></br></td>";
		}	
	}
/*
	echo "<tr><td>00:00</td></tr>";

	verificar_disponibilidad('00:00', '01:00');
	echo "<tr><td>01:00</td></tr>";
	verificar_disponibilidad('01:00', '02:00');
	echo "<tr><td>02:00</td></tr>";
	verificar_disponibilidad('02:00', '03:00');
	echo "<tr><td>03:00</td></tr>";
	verificar_disponibilidad('03:00', '04:00');
	echo "<tr><td>04:00</td></tr>";
	verificar_disponibilidad('04:00', '05:00');
	echo "<tr><td>05:00</td></tr>";
	verificar_disponibilidad('05:00', '06:00');
	echo "<tr><td>06:00</td></tr>";
	verificar_disponibilidad('06:00', '07:00');
	echo "<tr><td>07:00</td></tr>";
	verificar_disponibilidad('07:00', '08:00');
	echo "<tr><td>08:00</td></tr>";
	verificar_disponibilidad('08:00', '09:00');
	echo "<tr><td>09:00</td></tr>";
	verificar_disponibilidad('09:00', '10:00');
	echo "<tr><td>10:00</td></tr>";
	verificar_disponibilidad('10:00', '11:00');
	echo "<tr><td>11:00</td></tr>";
	verificar_disponibilidad('11:00', '12:00');
	echo "<tr><td>12:00</td></tr>";
	verificar_disponibilidad('12:00', '13:00');
	echo "<tr><td>13:00</td></tr>";
	verificar_disponibilidad('13:00', '14:00');
	echo "<tr><td>14:00</td></tr>";
	verificar_disponibilidad('14:00', '15:00');
	echo "<tr><td>15:00</td></tr>";
	verificar_disponibilidad('15:00', '16:00');
	echo "<tr><td>16:00</td></tr>";
	verificar_disponibilidad('16:00', '17:00');
	echo "<tr><td>17:00</td></tr>";
	verificar_disponibilidad('17:00', '18:00');
	echo "<tr><td>18:00</td></tr>";
	verificar_disponibilidad('18:00', '19:00');
	echo "<tr><td>19:00</td></tr>";
	verificar_disponibilidad('19:00', '20:00');
	echo "<tr><td>20:00</td></tr>";
	verificar_disponibilidad('20:00', '21:00');
	echo "<tr><td>21:00</td></tr>";
	verificar_disponibilidad('21:00', '22:00');
	echo "<tr><td>22:00</td></tr>";
	verificar_disponibilidad('22:00', '23:00');
	echo "<tr><td>23:00</td></tr>";
	verificar_disponibilidad('23:00', '00:00');
*/
}

function verificar_disponibilidad($horareserva, $horafin, $fechaR) {
	$estacionamiento = $_POST['estacionamiento'];
	$consulta = "SELECT count(id_reserva) as ocupados, fecha_reserva, hora_reserva, hora_fin, numero_puestos FROM reservas INNER JOIN puestos on ID_puesto = rela_puesto INNER JOIN estacionamiento ON id_estacionamiento = rela_estacionamiento WHERE rela_estacionamiento = ".$estacionamiento." AND fecha_reserva = '".$fechaR."' AND ((hora_reserva <= '".$horareserva."' AND hora_fin >= '".$horareserva."') OR (hora_reserva >= '".$horareserva."' AND hora_fin <= '".$horafin."'));";

	$matriz = consulta($consulta);
	$matrizEstados['libres'] = null;
	$matrizEstados['reservados'] = null;
	$matrizEstados['ocupados'] = null;
	foreach($matriz as $puestos) {
		if ($matriz <> null) {
			if($puestos['ocupados'] == 0) {
				$matrizEstados['libres'] = $puestos['numero_puestos'];
				$matrizEstados['reservados'] = 0;
			} else {
				$matrizEstados['reservados'] = $puestos['ocupados'];
				$matrizEstados['libres'] = $puestos['numero_puestos'] - $matrizEstados['reservados'];
			}
			
		} else {
			$matrizEstados['libres'] = $puestos['numero_puestos'];
			$matrizEstados['reservados'] = 0;
		}

	}
	$horareserva = strtotime($horareserva);
	$horafin = strtotime($horafin);
	$horaActual = date('h:i'); 
	$fechaActual = date('Y-m-d');

	if ($fechaActual = $fechaR && $horareserva >= $horaActual) {
		//Sacamos la cantidad de ocupados en el momento
		$matriz = null;
		$consulta = "SELECT COUNT(ID_Puesto) as cantidad, estado from puestos INNER JOIN estacionamiento on id_estacionamiento = rela_estacionamiento where estado = 1 and id_estacionamiento = ".$estacionamiento.";";
		$matriz = consulta($consulta);
		if ($matriz <> null) {
			$matrizEstados['ocupados'] = $matriz[0]['cantidad'];
		}
	}	else {
		$matrizEstados['ocupados'] = 0;
	}

	return $matrizEstados;
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