<?php 
require_once("config/funciones.php");
/*
$tabla="empleado";
$campos=array(
	"nombre"=>"Naydu Leiva",
	"usuario"=>"truskan",
	"clave"=>"a271b7e8f2f64b4de8af59abe18dd1e1",
	"email"=>"truskan.naydu@gmail.com",
	"foto"=>"img/users/naydu1372774321.jpg",
	"f_creacion"=>time()
);
insertar($tabla,$campos);

//print md5("truskan18");

*/
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Limoncito Borracho</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-responsive.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootbox.js"></script>

</head>
<body>

	<div>
		<div class="logo"></div>
		<div class="menu-nav"></div>
	</div>
	<div class="container">
		<div class="row">
			<div class="hero-unit">
				<h1>Limoncito Borracho</h1>
				<small>lo hacemos mas rico :p</small>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<?php include 'perfil.php'; ?>

				<ul class="nav nav-list">
					<li class="active"><a href="app_admin.php">Buscar</a></li>
					<li class="nav-header">Ventas</li>
					<li><a href="mesa_admin.php">Mesa Info</a></li>
					<li><a href="mesa_admin_actual.php">Mesas Actuales</a></li>
					<li class="nav-header">Inventario</li>
					<li><a href="producto_admin.php">Productos</a></li>
					<li><a href="ingrediente_admin.php">Ingredientes</a></li>
					<?php if ($_SESSION["admin"]) {?>
					<li class="nav-header">Personal</li>
					<li><a href="empleado_admin.php">Empleados</a></li>
					<li class="nav-header">Reportes</li>
					<li><a href="reporte.php">Reportes</a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="span9">
				<form action="" class="form-search text-center alert">
					<h1>Busca tus platos!!!</h1>
					<input type="text" class="input-xlarge search-query" name="q">
					<input type="submit" class="btn" value="Buscar">
				</form>
			</div>
		</div>
	</div>
</body>
</html>


<!--
		<h1>LIMONCITO BORRACHO</h1>
		<h2>lo hacemos mas rico :P</h2>

	-->