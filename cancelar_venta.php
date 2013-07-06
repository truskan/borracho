<?php 
session_start();
require_once("config/funciones.php");
if ($_POST["venta"]) {
	if (cancelarVenta($_POST["venta"])) {
		print cancelarVenta($_POST["venta"]);
	}
} else {
	header("location:mesa_admin.php");
}
?>
