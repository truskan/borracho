<?php 
require_once("config/funciones.php");
/*
$tabla="detalle_venta";
$campos=array(
	"id_venta"=>4,
	"cantidad"=>2,
	"id_producto"=>3
);
insertar($tabla,$campos);

//print md5("truskan18");

*/
//print time();
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
	<script type="text/javascript" src="js/change-state.js"></script>

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
					<li ><a href="app_admin.php">Buscar</a></li>
					<li class="nav-header">Ventas</li>
					<li><a href="mesa_admin.php">Mesa Info</a></li>
					<li><a href="mesa_admin_actual.php">Mesas Actuales</a></li>
					<li class="nav-header">Inventario</li>
					<li><a href="producto_admin.php">Productos</a></li>
					<li><a href="ingrediente_admin.php">Ingredientes</a></li>
					<?php if ($_SESSION["admin"]) {?>
					<li class="nav-header">Personal</li>
					<li class="active"><a href="empleado_admin.php">Empleados</a></li>
					<li class="nav-header">Reportes</li>
					<li><a href="reporte.php">Reportes</a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="span9">
				<h1>Administracion de Mesas</h1>
				<small>Configuracion de Mesas - <em>Parte inferior</em></small>
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<li class="active" ><a href="#tab1" data-toggle="tab">Estado</a></li>
						<?php if ($_SESSION["admin"]) { ?>
						<li ><a href="#tab2" data-toggle="tab">Nuevo</a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab1">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nº</th>
										<th>Nombre</th>
										<th>Usuario</th>
										<th>Clave</th>
										<th>E-mail</th>
										<th>Fecha<br>Creación</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$tabla=listarDatos("empleado");
										$i=1;
										foreach ($tabla as $item) { ?>
									<tr>
										<td><?php print $i;?></td>
										<td><?php print ucwords($item["nombre"]); ?></td>
										<td><?php print $item["usuario"]; ?></td>
										<td><?php print $item["clave"]; ?></td>
										<td><?php print $item["email"]; ?></td>
										<td><?php print substr($meses[date("n",$item["f_creacion"])+1],0,3)." ".date("j, Y, g:i a",$item["f_venta"]); ?></td>
										<td><button title="Añadir" venta="<?php print $item["id"];?>" class="btn btn-warning añadir-state" ><i class="icon-plus"></i></button><button title="Cancelar" venta="<?php print $item["id"];?>" class="btn btn-danger cancel-state" ><i class="icon-remove"></i></button></td>
									</tr>
									<?php
									$i++;
									}
									?>
								</tbody>
							</table>
							<p class="text-success">Vea el detalle de los empleados <strong><?php print ucwords($estado[1]);?></strong> haciendo click en el estado.</p>
						</div>
						<div class="tab-pane" id="tab2">
							<form class="form-horizontal" method="post" action="insertar_empleado.php" enctype='multipart/form-data'>
								<fieldset>
									<legend>Nuevo Empleado</legend>
									<div class="control-group">
										<label class="control-label" for="nombre">Nombre completo</label>
										<div class="controls">
											<input type="text" required="required" name="nombre" class="input-xlarge" value="<?php print ucwords($_COOKIE["nombre"]);?>" id="nombre">
											<p class="help-block">Opcional: <em>Nombre Apellido</em></p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="usuario">Usuario</label>
										<div class="controls">
											<input type="text" required="required" class="input-xlarge" name="usuario" value="<?php print $_COOKIE["usuario"];?>" id="usuario">
											<p class="help-block"><a href="#" class="verify-disponibility">Disponible?</a></em></p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="clave">Clave</label>
										<div class="controls">
											<input type="password" required="required" class="input-xlarge" name="clave" id="clave">
											<p class="help-block"><span id="len-pass"></span><?php print $_COOKIE["error_clave_diferente"];?></p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="clave">Repita la Clave</label>
										<div class="controls">
											<input type="password" required="required" class="input-xlarge" name="rclave" id="r-clave">
											<p class="help-block"><span id="equal-pass"></span></p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="clave">E-mail</label>
										<div class="controls">
											<input type="email" required="required" class="input-xlarge" name="email" value="<?php print $_COOKIE["email"];?>" id="e-mail">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="fileInput">File input</label>
										<div class="controls">
											<input class="input-file" id="fileInput" type="file">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<button class="btn">Cancel</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>


<!--
		<h1>LIMONCITO BORRACHO</h1>
		<h2>lo hacemos mas rico :P</h2>

	-->