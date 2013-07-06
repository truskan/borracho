<?php 
session_start();
require_once("config/funciones.php");
if ($_POST["producto"]) {
	if (eliminarProducto($_POST["producto"])) {
		print eliminarProducto($_POST["producto"]);
	}
} else {
	header("location:producto_admin.php");
}
?>
