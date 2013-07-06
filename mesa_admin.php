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
					<li class="active"><a href="mesa_admin.php">Mesa Info</a></li>
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
				<h1>Administracion de Mesas</h1>
				<small>Configuracion de Mesas - <em>Parte inferior</em></small>
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<li class="active" ><a href="#tab1" data-toggle="tab">Estado</a></li>
						<?php if ($_SESSION["admin"]) { ?>
						<li ><a href="#tab2" data-toggle="tab">Ranking</a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab1">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nº</th>
										<th>Mesa Descripcion</th>
										<th>Visibilidad</th>
										<th>Cambiar Estado</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$tabla=listarVentas();
										$mesas_en_uso=array();
										foreach ($tabla as $item) {
											$mesas_en_uso[]=$item["mesa"];
										}
									for ($i=1; $i<$mesas_len+1 ; $i++) { ?>
									<tr>
										<td><?php print $i;?></td>
										<td>Mesa Nº <?php print $i; ?></td>
										<?php 
											$sw=true;
											foreach ($mesas_en_uso as $item) {
											if ($i==$item) { ?>
										<td><p class="text-warning"><a href="mesa_admin_actual.php?venta=<?php print $item;?>"><?php print ucwords($estado[1]);?></a></p></td>
										<td><button venta="<?php print $i;?>" class="btn btn-success terminate-state" >Terminar</button> | <button  venta="<?php print $i;?>" class="btn btn-danger cancel-state" >Cancelar</button> </td>
											<?php
											$sw=false;
											} 
											}
											if ($sw) { ?>
										<td><p ><a class="text-error" href="mesa_admin_actual.php?nueva_venta=<?php print $i;?>"><?php print ucwords($estado[2]);?></a></p></td>
										<td><br></td>
										<?php
											}
											?>
									</tr>
									<?php
									}
									?>
								</tbody>
							</table>
							<p class="text-success">Vea el detalle de la mesa <strong><?php print ucwords($estado[1]);?></strong> haciendo click en el estado.</p>
						</div>
						<div class="tab-pane" id="tab2">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Mesa</th>
										<th>Forma de Pago</th>
										<th>Empleado</th>
										<th>Totales<br>S/.</th>
										<th>Fecha</th>
										<th>Estado</th>
										<th>Cancelado</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$tabla=rankingVentas();
									foreach ($tabla as $item) { ?>
									<tr>
										<td><?php print $item["mesa"];?></td>
										<td class="text-error"><strong><?php print strtoupper($forma_venta[$item["forma_pago"]]);?></strong></td>
										<td><?php print ucwords($item["empleado"]);?></td>
										<td><?php print $item["totales"]; ?></td>
										<td><?php print substr($meses[date("n",$item["f_venta"])+1],0,3)." ".date("j, Y, g:i a",$item["f_venta"]); ?></td>
										<td><?php print strtoupper($estado[$item["estado"]]); ?></td>
										<td class="text-success"><strong><?php print strtoupper($cancelado[$item["cancelado"]]); ?></strong></td>
									</tr>
									<?php
									}
									?>
									
								</tbody>
							</table>
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