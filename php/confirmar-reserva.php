<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- css -->
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<link href="../css/tablas-estilo.css" rel="stylesheet">s
<link href="../css/style.css" rel="stylesheet">

<!-- skin color -->
<link href="color/default.css" rel="stylesheet">
<link rel="shortcut icon" href="img/favicon.ico">

</head>
<?php include('reservas-funciones.php');
?>
<body>
<!-- navbar -->
<div class="navbar-wrapper">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<!-- Responsive navbar -->
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</a>
				<h1 class="brand"><a href="../index.php">AutoSpace</a></h1>
				<!-- navigation -->
				<nav class="pull-right nav-collapse collapse">
				<ul id="menu-main" class="nav">			
				        <li class="dropdown">
				          <a title="Gestion" href="#Gestion" class="dropdown-toggle" data-toggle="dropdown">Gestion de datos <b class="caret"></b></a>
				          <ul class="dropdown-menu">
				      

				            <li><a href="#works" target="" href="registro.php" target="muestrario">Personas</a></li>
				            	<li class="dropdown-submenu">
                					<a tabindex="-1" href="#works">Vehiculos</a>
               			 			<ul class="dropdown-menu">
					                <li><a tabindex="-1" href="#">Registrar</a></li>
					                <li><a tabindex="-1" href="#">Mis vehiculos</a></li>
					                </ul>
					            </li>



				            <li><a href="index.php#works">Reservas</a></li>
				            <li><a href="#works">Estacionamiento</a></li>
				          </ul>
				        </li>

     				<li><a href="../login.php">Iniciar Sesion</a></li>
					<li><a title="Gestion de datos" href="../index.php#works">Gestion de datos</a></li>
					<li><a title="Horarios" href="#horarios">Horarios</a></li>





					<li><a title="contacto" href="#contacto">Contacto</a></li>
					<li><a href="page.html">Page</a></li>
					<li><a href="Camaras.html">Camaras</a></li>
				</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- spacer section -->
<section class="celestial">
	
	<div class="datagrid" style="width: 30%; margin: 0 auto;">
		<table>
			<thead>
				<tr>
					<th>Número de puesto</th>
					<th>Seleccionar</th>
				<tr>
			</thead>
			<tbody>
			<form action="" method="post">
			<?php
			puestos_disponibles($_SESSION['fechareserva'], $_SESSION['horareserva'], $_SESSION['horafin']); ?>
			</form>
			</tbody>
		</table>
	</div>
</section>

<footer>
<div class="container">
	<div class="row">
		<div class="span6 offset3">
			<ul class="social-networks">
				<li><a href="#"><i class="icon-circled icon-bgdark icon-instagram icon-2x"></i></a></li>
				<li><a href="#"><i class="icon-circled icon-bgdark icon-twitter icon-2x"></i></a></li>
				<li><a href="#"><i class="icon-circled icon-bgdark icon-dribbble icon-2x"></i></a></li>
				<li><a href="#"><i class="icon-circled icon-bgdark icon-pinterest icon-2x"></i></a></li>
			</ul>
			<p class="copyright">
				&copy; Autospace - 2017.
			</p>
		</div>
	</div>
</div>
<!-- ./container -->
</footer>

<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- nav -->
<script src="js/jquery.scrollTo.js"></script>
<script src="js/jquery.nav.js"></script>
<!-- localScroll -->
<script src="js/jquery.localscroll-1.2.7-min.js"></script>
<!-- bootstrap -->
<script src="js/bootstrap.js"></script>
<!-- prettyPhoto -->
<script src="js/jquery.prettyPhoto.js"></script>
<!-- Works scripts -->
<script src="js/isotope.js"></script>
<!-- flexslider -->
<script src="js/jquery.flexslider.js"></script>
<!-- inview -->
<script src="js/inview.js"></script>
<!-- animation -->
<script src="js/animate.js"></script>
<!-- twitter -->
<script src="js/jquery.tweet.js"></script>
<!-- contact form -->
<script src="js/validate.js"></script>
<!-- custom functions -->
<script src="js/custom.js"></script>
</body>
</html>