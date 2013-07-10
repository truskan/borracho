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
	<script type="text/javascript" src="js/img-preview.js"></script>

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
					<li class="active"><a href="producto_admin.php">Productos</a></li>
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
				<h1>Administracion de Productos</h1>
				<small>Configuracion de Productos - <em>Parte inferior</em></small>
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
										<th>Producto</th>
										<th>Ingredientes</th>
										<th>P. Venta</th>
										<th>Descripcion</th>
										<th>Creado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$tabla=listarDatos("producto");
										$i=1;
										foreach ($tabla as $item) { ?>
									<tr>
										<td><?php print $i;?></td>
										<td><?php print ucwords($item["producto"]); ?></td>
										<td>
											<table class="table-bordered">
												<thead>
													<tr>
														<th>Ingredientes</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$tabla=listarIngrediente($item["id"]);
													foreach ($tabla as $item1) { ?>
													<tr>
														<td><?php print ucwords($item1["ingrediente"]);?></td>
													</tr>	
													<?php
													}
													?>
													
												</tbody>
											</table>
										</td>
										<td><?php print $item["p_venta"];?></td>
										<td><?php print $item["descripcion"];?></td>
										<td><?php print substr($meses[date("n",$item["f_creacion"])+1],0,3)." ".date("j, Y, g:i a",$item["f_creacion"]); ?></td>
										<td><button producto="<?php print $item["id"];?>" class="btn btn-danger delete-product" ><i class="icon-remove"></i></button><a href="producto_admin.php?a=editar&t=producto&id=<?php print $item["id"];?>" role="button" data-toggle="modal" class="btn btn-warning" ><i class="icon-edit"></i></a></td>
									</tr>
									<?php
									$i++;
									}
									?>
								</tbody>
							</table>
							<p class="text-success">Vea el detalle de la mesa <strong><?php print ucwords($estado[1]);?></strong> haciendo click en el estado.</p>
						</div>
						<div class="tab-pane" id="tab2">
							<form class="form-horizontal" method="post" action="insertar_producto.php" enctype='multipart/form-data'>
								<fieldset>
									<legend>Nuevo Producto</legend>
									<div class="control-group">
										<label class="control-label" for="producto">Nombre del Producto</label>
										<div class="controls">
											<input type="text" required="required" class="input-xlarge" id="producto" name="producto">
											<p class="help-block">Nombre que aparecera en el Menu.</p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="p_venta">Precio Venta</label>
										<div class="controls">
											<input type="text" required="required" class="input-mini" id="p_venta" name="p_venta">
											<p class="help-block">Relativo.</p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="optionsCheckbox">Categoria</label>
										<div class="controls">
											<label class="radio">
												<input type="radio" id="optionsRadios" name="categoria" value="1">Perecible<br>
												<input type="radio" id="optionsRadios" name="categoria" value="2">No Perecible<br>
											</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="descripcion">Descripcion</label>
										<div class="controls">
											<textarea class="input-xlarge" required="required" id="textarea" name="descripcion" rows="3"></textarea>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="foto">Foto</label>
										<div class="controls">
											<input class="input-file" id="fileInput" name="foto" type="file">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="estrella">Plato Estrella</label>
										<div class="controls">
											<label class="checkbox">
												<input type="checkbox" name="estrella" value="1">
											</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="Ingredientes">Ingredientes</label>
										<div class="controls">
											<select multiple="multiple" name="ingrediente[]" id="ingrediente">
												<?php 
												$tabla=listarTodosIngredientes();
												foreach ($tabla as $item) { ?>
												<option value="<?php print $item["id"];?>"><?php print ucwords($item["ingrediente"]);?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="control-group add-ingrediente">
										<div class="controls">
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
							<form class="form-horizontal" action="editar.php" method="post" enctype='multipart/form-data'>
								<fieldset>
									<legend>Editar Producto</legend>
									<input type="hidden" name="t" value="<?php print $_GET["t"]; ?>"/>
									<input type="hidden" name="id" value="<?php print $_GET["id"]; ?>"/>
									<div class="control-group">
										<label class="control-label" for="producto">Nombre del Producto</label>
										<div class="controls">
											<input type="text" required="required" class="input-xlarge" name="producto" value="<?php print ucwords($item["producto"]); ?>">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="p_venta">Precio de Venta</label>
										<div class="controls">
											<input type="text" required="required" class="input-mini" name="p_venta" value="<?php print $item["p_venta"]; ?>">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="ingrediente">Ingredientes</label>
										<div class="controls">
											<select multiple="multiple" name="ingrediente[]" id="ingrediente-edit">
											<?php 
											$nombres=listarIngrediente($item["id"]);
											$total=listarTodosIngredientes();
											foreach ($nombres as $item2) { ?>
												<option selected value="<?php print $item2["id_ingrediente"];?>"><?php print ucwords($item2["ingrediente"]);?></option>
											<?php
												unset($total[$item2["id_ingrediente"]]);
											}
											foreach ($total as $item1) { ?>
												<option  value="<?php print $item1["id"];?>"><?php print ucwords($item1["ingrediente"]);?></option>
											<?php	
											}
											?>
											</select>
										</div>
									</div>		
									<div class="control-group add-ingrediente-edit">
										<label for="cantidad" class="control-label">Cantidades</label>
										<div class="controls">
										<?php
										foreach ($nombres as $item1) { ?>
											<input type='text' name='cantidad[]' class='input-mini' value='<?php print $item1["cantidad"];?>' placeholder='0'/> <?php print ucwords($item1["ingrediente"]);?><br>
										<?php 
										}
										?>
										</div>
									</div>								
									<div class="control-group">
										<label class="control-label" for="descripcion">Descripcion</label>
										<div class="controls">
											<textarea class="input-xlarge" name="descripcion" required="required" rows="3"><?php print $item["descripcion"];?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="foto">Foto</label>
										<div class="controls">
											<input class="input-file" id="foto" name="foto" type="file">
										</div>
									</div>
									<div class="control-group foto-preview">
										<label class="control-label" for="prefoto">Previsualizacion</label>
										<div class="controls">
											<img src="<?php print $item["foto"];?>"  alt="Tu Producto" id="foto-preview" class="img-rounded span3">
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