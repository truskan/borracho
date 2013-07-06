<?php
require_once("config/funciones.php");
if($_POST){
	$nombre=limpiarTexto(strtolower($_POST["nombre"]));
	$usuario=$_POST["usuario"];
	$clave=$_POST["clave"];
	$rclave=$_POST["rclave"];
	$email=$_POST["email"];
	if (!($clave!=$rclave)) {
		setcookie("nombre",$nombre,time()+30);
		setcookie("usuario",$usuario,time()+30);
		setcookie("email",$email,time()+30);
		setcookie("error_clave_diferente","<p class='text-error'>Las Contraseñas no coinciden!!!</p>",time()+30);
		header("location:empleado_admin.php");
	}
	$nombre_foto=time();
	if (strlen($_FILES['foto']['name'])>0) {
		$foto="img/usuarios/$nombre_foto.".extensiones($_FILES['foto']['type']);
		copy($_FILES['foto']['tmp_name'],$foto);
		//$sql="update usuario set nombres='$nombres', email='$email',imagen='$origen' where id_usuario='".$_SESSION["usuario"]["codigo"]."'";
	}
	else {
		$foto="img/usuarios/default.png";
	}
	$f_creacion=time();
	$campos=array(
		"nombre"=>$nombre,
		"usuario"=>$usuario,
		"clave"=>md5($clave),
		"email"=>$email,
		"foto"=>$foto,
		"f_creacion"=>$f_creacion
	);
	insertar("empleado",$campos);
	header("location:empleado_admin.php");

}else {
	header("location:app_admin.php");
}

?>