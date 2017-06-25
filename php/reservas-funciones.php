<?php
require('funciones.php');
$FechasSemana = obtener_fechas();//en este array guardo las fechas de la semana vigente segun la fecha actual

//-------------------------Funciones de Modulo Reservas---------------------------
function cargar_horarios() {
	
	$horaSig = 0;
	for($i = 0; $i < 24; $i++) {
		$hora = $i.":00";
		$horaSig = intval($i + 1);
		$horaFinal = $horaSig.":00";

		if($i % 2 == 0) {
			$barraAlterna = "<tr class='alt'>";
		} else {
			$barraAlterna = "<tr>";
		}

		echo $barraAlterna."<td>".$hora."</td>";
		
		

		foreach($GLOBALS['FechasSemana'] as $dia=>$valor) {
			//Recorro la matriz fechasSemana y le mando un verificar a ese horario
			$matrizEstados = null;
			$matrizEstados = verificar_disponibilidad($hora, $horaFinal, $valor);
			echo "<td><p ".determinar_color("libres", $matrizEstados['libres']).">Libres: ".$matrizEstados['libres']."</p></br>";
			echo "<p ".determinar_color("reservados", $matrizEstados['reservados']).">Reservados: ".$matrizEstados['reservados']."</p></br>";
			echo "<p ".determinar_color("ocupados", $matrizEstados['ocupados']).">Ocupados: ".$matrizEstados['ocupados']."</p></br></td>";
		}
		echo "</tr>";
	}

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

	$horaActual = date('h:i');	//hora actual

	//formato de hora reserva y hora actual
	$horareserva = strtotime($horareserva);	
	$horaActual = strtotime($horaActual);

	$horaSiguiente = strtotime('+1 hour', $horareserva); //le sumo una hora a la hora de la reserva
	$fechaActual = date('Y-m-d');	//guardo la fecha actual

	if ($fechaActual == $fechaR && $horaActual >= $horareserva && $horaActual <= $horaSiguiente) {
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
	$dias = array('lunes','martes','miercoles','jueves','viernes','sabado', 'domingo');
	$fecha = $dias[date('N', strtotime($fecha_actual)) - 1]; //menos 1 porque domingo devuelve 7 y no hay indice 7
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

function asignar_fechas_tabla() {
	$lunes = date_create($GLOBALS['FechasSemana']['lunes']);
	$lunes = date_format($lunes, "d/m");
	$martes = date_create($GLOBALS['FechasSemana']['martes']);
	$martes = date_format($martes, "d/m");
	$miercoles = date_create($GLOBALS['FechasSemana']['miercoles']);
	$miercoles = date_format($miercoles, "d/m");
	$jueves = date_create($GLOBALS['FechasSemana']['jueves']);
	$jueves = date_format($jueves, "d/m");
	$viernes = date_create($GLOBALS['FechasSemana']['viernes']);
	$viernes = date_format($viernes, "d/m");
	$sabado = date_create($GLOBALS['FechasSemana']['sabado']);
	$sabado = date_format($sabado, "d/m");
	$domingo = date_create($GLOBALS['FechasSemana']['domingo']);
	$domingo = date_format($domingo, "d/m");

	echo "<th>Lunes ".$lunes."</th>";
	echo "<th>Martes ".$martes."</th>";
	echo "<th>Miércoles ".$miercoles."</th>";
	echo "<th>Jueves ".$jueves."</th>";
	echo "<th>Viernes ".$viernes."</th>";
	echo "<th>Sábado ".$sabado."</th>";
	echo "<th>Domingo ".$domingo."</th>";
}

function determinar_color($tipo, $valor) {
	switch($tipo) {
		case "reservados":
			if ($valor > 0) {
				return "style='color: #705816; font-weight: bold;'";
			}
			break;
		case "libres":
			if ($valor > 0) {
				return "style='color: #23B923; font-weight: bold;'";
			}
			break;
		case "ocupados":
		if ($valor > 0) {
				return "style='color: #F94513; font-weight: bold;'";
			}
			break;
	}
} 
?>