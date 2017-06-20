<?php
//Funciones de Modulo Reservas
require('funciones.php');

function cargar_horarios() {
	$culta= "SELECT count(rela_puesto) as libres, fecha_reserva, hora_reserva, hora_fin, estado FROM reservas INNER JOIN puestos ON id_puesto = rela_puesto INNER JOIN estacionamiento ON id_estacionamiento = rela_estacionamiento WHERE rela_estacionamiento = 1 AND hora_reserva >= '".$horareserva."' AND hora_fin <= '".$horafin."' OR hora_fin > '".$horafin."' GROUP BY estado";
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
?>