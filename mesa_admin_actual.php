<?php 
require_once("config/funciones.php");
/*
if ($_GET["nueva_venta"]) {
	$tab_nueva_venta=true;
} elseif($_GET["venta"]){
	$tab_vista_venta=true;
}
*/
/*
$tabla="detalle_plato";
for ($i=1; $i <7 ; $i++) { 
	$campos=array(
	"id_producto"=>3,
	"id_ingrediente"=>$i,
	"cantidad"=>0.25
);
insertar($tabla,$campos);	
}

*/

//print md5("truskan18");


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
					<li class="active"><a href="mesa_admin_actual.php">Mesas Actuales</a></li>
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
						<!--
						<li <?php if ($tab_nueva_venta) {?> class="active" <?php } elseif($_GET) {?> class="active" <?php } ?>><a href="#tab1" data-toggle="tab">Detalle Mesas</a></li>
						<li <?php if ($tab_vista_venta) {?> class="active" <?php } ?>><a href="#tab2" data-toggle="tab">Nueva Venta</a></li>
-->
						<li <?php 
						if(!($_GET["nueva_venta"])) { ?>
						 	class="active"
						<?php						
						}
						?>><a href="#tab1" data-toggle="tab">Detalle Mesas</a></li>
						<li <?php 
						if($_GET["nueva_venta"]) { ?>
							class="active"
						<?php
						}
						?>><a href="#tab2" data-toggle="tab">Nueva Venta</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane<?php if (!($_GET["nueva_venta"])) { ?> active <?php }?>" id="tab1">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Nº</th>
										<th>Mesa Descripcion</th>
										<th>Total</th>
										<th>Fecha</th>
										<th>Cliente</th>
										<th>Empleado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$tabla=listarVentasActivas();
										$i=0;
										foreach ($tabla as $item) {	?>		
									<tr>
										<td><?php print $item["mesa"];?></td>
										<td>
										<table class="table-bordered">
											<thead>
												<tr>
													<th>Cant.</th>
													<th>Producto</th>
													<th>Precio</th>
												</tr>
											</thead>
											<tbody>
										<?php
										//$campo=array("id_venta"=>array_keys($tabla)[$i]);
										$tabla1=listarDetalleVenta(array_keys($tabla)[$i]);
										foreach ($tabla1 as $item1) {?>
										
										<tr>
											<td><?php print $item1["cantidad"];?></td>
											<td><?php print ucwords($item1["producto"]);?></td>
											<td><?php print $item1["p_venta"];?></td>
										</tr>

										<?php
										}
										?>
										</tbody>
											</table>
										</td>
										<td><?php print $item["total_venta"]; ?></td>
										<td><?php print substr($meses[date("n",$item["f_venta"])+1],0,3)." ".date("j, Y, g:i a",$item["f_venta"]); ?></td>
										<td><?php print ucwords($item["cliente"]);?></td>
										<td><?php print ucwords($item["empleado"]);?></td>
										<td><button title="Terminar" venta="<?php print array_keys($tabla)[$i];?>" class="btn btn-success terminate-state" ><i class="icon-ok"></i></button><button title="Añadir" venta="<?php print array_keys($tabla)[$i];?>" class="btn btn-warning añadir-state" ><i class="icon-plus"></i></button><button title="Cancelar" venta="<?php print array_keys($tabla)[$i];?>" class="btn btn-danger cancel-state" ><i class="icon-remove"></i></button></td>
									</tr>
									<?php
									$i++;
									}
									?>
								</tbody>
							</table>
							<p class="text-success">Vea el detalle de la mesa <strong><?php print ucwords($estado[1]);?></strong> haciendo click en el estado.</p>
						</div>
						<div class="tab-pane<?php if ($_GET["nueva_venta"]) { ?> active <?php }?>" id="tab2">
							<form class="form-horizontal" method="post" action="insertar_detalle_venta.php">
								<fieldset>
									<legend>Nueva venta en Mesa <span class="mesa-id"><?php if (!($_GET)) { print ""; } else { print "Nº ".$_GET["nueva_venta"]; } ?></span></legend>
									<div class="control-group">
										<label class="control-label" for="mesa">Mesa Nº</label>
										<div class="controls">
											<select id="mesa" class="span1" name="mesa">
												<?php
												$mesas_libres=mesasLibres($mesas_len);
												foreach ($mesas_libres as $item) { 
													if ($item==$_GET["nueva_venta"]) { ?>
														<option selected value="<?php print $item;?>"><?php print $item;?></option>
													<?php
													} else {
												?>
													<option value="<?php print $item;?>"><?php print $item;?></option>
													<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="cliente">Cliente</label>
										<div class="controls">
											<input type="text" class="input-xlarge" name="cliente" id="input01">
											<p class="help-block">Si no eres usuario se te agrega!</p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="multiSelect">Productos</label>
										<div class="controls">
											<select multiple="multiple" id="producto" class="product" name="producto[]">
												<?php
													foreach (listarDatos("producto") as $item) { ?>
													<option value=<?php print $item["id"];?>><?php print $item["producto"]; ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="control-group add-product">
										<div class="controls">
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Listo!"/>
										<input class="btn" type="reset" value="De nuevo!"/>
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