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
if ($_SESSION["id_usuario"]) {
	header("location:app_admin.php");
} else {
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
					<li class="active"><a href="index.php">Inicio</a></li>
					<li ><a href="acerca.php">Acerca de</a></li>
					<li ><a href="contacto.php">Contactenos</a></li>
					<li >
						<div class="well">
							<form action="verificar_usuario.php" method="post">
								<fieldset>
									<h3>Login</h3>
									<input type="text" placeholder="usuario" name="usuario">
									<input type="password" placeholder="contraseña" name="clave">
									<input type="submit" class="btn btn-primary" value="Login"><br>
									<?php if (strlen($_COOKIE["error_login"])>0 ){
									?>
										<p class="text-warning"><?php print $_COOKIE["error_login"];?></p>
									<?php } ?>
									<a href="#" class="btn btn-info">Registrar</a>
								</fieldset>
							</form>
						</div>
					</li>
				</ul>
			</div>
			<div class="span8">
				<div id="myCarousel" class="carousel slide">
					<div class="carousel-inner">
						<?php 
						$carousel_data=listarDatos("producto");
						foreach($carousel_data as $carousel_item) {
							if ($carousel_item["estrella"]==1) {
						?>
						<div class="item active">
						<?php } else { ?>
						<div class="item">
						<?php } ?>
							<img src="<?php print $carousel_item["foto"];?>" alt="<?php print ucwords($carousel_item["producto"]);?>">
							<div class="carousel-caption">
								<h4><?php print ucwords($carousel_item["producto"]); ?></h4>
								<p><?php print $carousel_item["descripcion"];?></p>
							</div>
						</div>
						<?php } ?>
					</div>
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
				</div>
				
			</div>
		</div>
	</div>
</body>
</html>

<?php } ?>
<!--
		<h1>LIMONCITO BORRACHO</h1>
		<h2>lo hacemos mas rico :P</h2>

	-->