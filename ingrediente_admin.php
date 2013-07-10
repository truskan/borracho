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
					<li class="active"><a href="ingrediente_admin.php">Ingredientes</a></li>
					<?php if ($_SESSION["admin"]) {?>
					<li class="nav-header">Personal</li>
					<li><a href="empleado_admin.php">Empleados</a></li>
					<li class="nav-header">Reportes</li>
					<li><a href="reporte.php">Reportes</a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="span9">
				<h1>Administracion de Ingrediente</h1>
				<small>Configuracion de Ingrediente - <em>Parte inferior</em></small>
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<?php 
						if ($_GET["t"]) { 
							$sw=true;?>
						<li ><a href="#tab1" data-toggle="tab">Estado</a></li>
						<?php } else {?>
						<li class="active" ><a href="#tab1" data-toggle="tab">Estado</a></li>
						<?php 
						}
						?>
						<?php if ($_SESSION["admin"]) { ?>
						<li ><a href="#tab2" data-toggle="tab">Nuevo</a></li>
						<?php } ?>
						<?php if ($_GET["t"]) { ?>
						<li class="active"><a href="#tab3" data-toggle="tab">Editar</a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
						<div class="tab-pane <?php if (!($sw)) { ?> active" <?php } ?> id="tab1">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nº</th>
										<th>Ingrediente</th>
										<th>Costo</th>
										<th>Stock</th>
										<th>Fecha<br>Compra</th>
										<th>Fecha<br>Vencimiento</th>
										<th>Estado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$tabla=listarDatos("ingrediente");
										$i=1;
										foreach ($tabla as $item) { ?>
									<tr>
										<td><?php print $i;?></td>
										<td><?php print ucwords($item["ingrediente"]); ?></td>
										<td><?php print $item["costo"]; ?></td>
										<td><?php print $item["stock"]; ?></td>
										<td><?php print date("d/m/Y",$item["f_vencimiento"]); ?></td>
										<td><?php print date("d/m/Y",$item["f_vencimiento"]);   ?></td>
										<td><?php print strtoupper($estado_in[$item["estado"]]); ?></td>
										<td><button ingrediente="<?php print $item["id"];?>" class="btn btn-danger delete-ingrediente" ><i class="icon-remove"></i></button><a href="ingrediente_admin.php?a=editar&t=ingrediente&id=<?php print $item["id"];?>" role="button" data-toggle="modal" class="btn btn-warning" ><i class="icon-edit"></i></a></td>
									</tr>
									<?php
									$i++;
									}
									?>
								</tbody>
							</table>
							<p class="text-success">Vea el detalle de la Ingrediente <strong><?php print ucwords($estado[1]);?></strong> haciendo click en el estado.</p>
						</div>
						<div class="tab-pane" id="tab2">
							<form class="form-horizontal" method="post" action="insertar_ingrediente.php" enctype='multipart/form-data'>
								<fieldset>
									<legend>Nuevo Ingrediente</legend>
									<div class="control-group">
										<label class="control-label" for="ingrediente">Nombre del Ingrediente</label>
										<div class="controls">
											<input type="text" required="required" class="input-xlarge" id="ingrediente" name="ingrediente">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="costo">Costo Unitario</label>
										<div class="controls">
											<input type="text" required="required" class="input-mini" id="costo" name="costo">
											<p class="help-block">Relativo.</p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" required="required" for="stock">Stock</label>
										<div class="controls">
											<input type="text" class="input-mini" id="stock" name="stock">
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Listo!"/>
										<input type="reset" class="btn" value="Cancel"/>
									</div>
								</fieldset>
							</form>
						</div>
						<div class="tab-pane <?php if ($sw) {?>active<?php }?>" id="tab3">
							<?php 
							$campo=array("id"=>$_GET["id"]);
							$tabla=$_GET["t"];
							$accion=$_GET["a"];
							$tabla=listarDatosPorCampoUnico($tabla,$campo);
							foreach ($tabla as $item) { ?>	
							<form class="form-horizontal" action="editar.php" method="post">
								<fieldset>
									<legend>Editar Ingrediente</legend>
									<input type="hidden" name="t" value="<?php print $_GET["t"]; ?>"/>
									<input type="hidden" name="id" value="<?php print $_GET["id"]; ?>"/>
									<div class="control-group">
										<label class="control-label" for="producto">Nombre del Ingrediente</label>
										<div class="controls">
											<input type="text" required="required" class="input-xlarge" name="ingrediente" value="<?php print ucwords($item["ingrediente"]); ?>">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="costo">Costo</label>
										<div class="controls">
											<input type="text" required="required" class="input-mini" name="costo" value="<?php print $item["costo"]; ?>">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="sotck">Stock</label>
										<div class="controls">
											<input type="text" required="required" class="input-mini" name="stock" value="<?php print $item["stock"]; ?>">
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Listo!"/>
									</div>
									<?php } ?>
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