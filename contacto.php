<?php 
require_once("config/funciones.php");
/*
$tabla="producto";
$campos=array(
	"producto"=>"Chilcano",
	"p_venta"=>3,
	"p_costo"=>1.5,
	"categoria"=>1,
	"descripcion"=>"Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.",
	"foto"=>"chilcano1372774321.jpg",
	"estrella"=>2,
	"f_creacion"=>time()
);
insertar($tabla,$campos);

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
	<script type="text/javascript">
	$(document).ready(function() {
		//bootbox.alert("Hola");
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
			<div class="span4">
				<ul class="nav nav-list">
					<li class="nav-header">Limoncito Borracho</li>
					<li ><a href="index.php">Inicio</a></li>
					<li ><a href="acerca.php">Acerca de</a></li>
					<li class="active"><a href="contacto.php">Contactenos</a></li>
					<li >
						<div class="well">
							<form action="verificar_usuario.php" method="post">
								<fieldset>
									<h3>Login</h3>
									<input type="text" placeholder="usuario" name="usuario">
									<input type="password" placeholder="contraseña" name="clave">
									<input type="submit" class="btn btn-primary" value="Login"><br>
									<a href="#" class="btn btn-info">Registrar</a>
								</fieldset>
							</form>
						</div>
					</li>
				</ul>
			</div>
			<div class="span8">
				<form class="form-horizontal">
					<fieldset>
						<legend>Diga hola!!!</legend>
						<div class="control-group">
							<label class="control-label" for="nombre">Nombre</label>
							<div class="controls">
								<input type="text" class="input-xlarge" required="required" name="nombre" placeholder="Nombre Completo" id="input01">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="email">E-mail</label>
							<div class="controls">
								<input type="email" class="input-xlarge"  required="required" name="email" placeholder="tucorreo@tudominio.com" id="input01">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="asunto">Contenido</label>
							<div class="controls">
								<textarea class="input-xlarge" id="textarea"  required="required" placeholder="" rows="3"></textarea>
							</div>
						</div>
						<div class="form-actions">
							<input type="submit" class="btn btn-primary" value="Enviar"/>
							<input class="btn" type="reset" value="Limpiar" />
						</div>
					</fieldset>
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