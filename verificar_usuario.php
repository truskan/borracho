<?php
session_start();
if ($_POST["usuario"] and $_POST["clave"]) {
	require_once("config/funciones.php");
	$usuario=limpiarTexto($_POST["usuario"]);
	$clave=limpiarTexto($_POST["clave"]);
	$logeo=login($usuario,$clave);
	if(is_numeric($logeo)){
		$_SESSION["id_usuario"]=$logeo;
		if ($_SESSION["id_usuario"]==1) {
			$_SESSION["admin"]=1;
		}
		header("location:app_admin.php");
	} else {
		setcookie("error_login","El usuario no existe o te confundiste al ingresar!!!",time()+5);
		header("location:index.php");
	}
}
?>