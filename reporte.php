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
	<link rel="stylesheet" href="css/bootstrap-select.min.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/bootstrap-responsive.css">
	<script type="text/javascript" src="js/jquery.jqplot.css"></script>
	<script type="text/javascript" src="js/jquery.jqplot.min.css"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-select.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/jquery.jqplot.js"></script>
	<script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
	<script type="text/javascript" src="js/bootbox.js"></script>
	<script type="text/javascript" src="js/change-state.js"></script>
	


	<script type="text/javascript">
	$(document).ready(function(){


		
		$("#reportType").change(function(){
			//Raporte Mensual
			$("#add-report-type-buttons").hide();
			if ($(this).val()==1) {	
				$("#add-report-type-buttons").show();
			}
			if ($(this).val()==2) {	
				$("#add-report-type-buttons").show();
			}
			if ($(this).val()==3) {
				$("#add-report-type").html('<label for="mes" class="control-label">Mes</label><div class="controls"><select class="selectpicker" name="mes"><option value="0">Enero</option><option value="1">Febrero</option><option value="2">Marzo</option><option value="3">Abril</option><option value="4">Mayo</option><option value="5">Junio</option><option value="6">Julio</option><option value="7">Agosto</option><option value="8">Setiembre</option><option value="9">Octubre</option><option value="10">Noviembre</option><option value="11">Diciembre</option></select></div>');
				$("#add-report-type-buttons").show();
			}
			if ($(this).val()==4) {
				$("#add-report-type").html('<label for="anio" class="control-label">Año</label><div class="controls"><input type="text" class="input-mini" id="anio" name="anio"></div>');
				$("#add-report-type-buttons").show();
			}
			if ($(this).val()==5) {
				$("#add-report-type").html('<label for="fecha1" class="control-label">Fechas</label><div class="controls"><div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy"><input class="span2" size="16" type="text" value="12-02-2012" ><span class="add-on"><i class="icon-calendar"></i></span></div> <div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy"><input class="span2" size="16" type="text" value="12-02-2012" ><span class="add-on"><i class="icon-calendar"></i></span></div></div>');
				$("#add-report-type-buttons").show();
			}
		});
	});
	</script>
	
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
					<li><a href="empleado_admin.php">Empleados</a></li>
					<li class="nav-header">Reportes</li>
					<li class="active"><a href="reporte.php">Reportes</a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="span9">
				<h1>Administracion de Productos</h1>
				<small>Configuracion de Productos - <em>Parte inferior</em></small>
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<li class="active" ><a href="#tab1" data-toggle="tab">Reportes</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab1">
							<form class="form-horizontal">
								<div class="control-group">
									<label class="control-label" for="select01">Tipo de Reporte</label>
									<div class="controls">
										<select name="tipo" id="reportType" class="selectpicker">
										<?php 
										$i=1;
										foreach ($reporte_tipo as $item) { ?>
											<option value="<?php print $i;?>"><?php print ucwords($item);?></option>
										<?php
										$i++;
										}
										?>
										</select>
									</div>
								</div>
								<div class="control-group" id="add-report-type">
								</div>
								<div class="control-group" id="add-report-type-buttons">
									<div class="form-actions">
										<button type="submit" class="btn btn-primary" value="Listo!"/>
										<input type="reset" class="btn" value="Cancel"/>
									</div>
								</div>

							</form>
							<p class="text-success">Vea el detalle de la mesa <strong><?php print ucwords($estado[1]);?></strong> haciendo click en el estado.</p>
							<div id="barra">
								
							</div>
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