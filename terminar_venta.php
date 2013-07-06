<?php 
session_start();
require_once("config/funciones.php");
if ($_POST["venta"]) {
	if (terminarVenta($_POST["venta"])) {
		print terminarVenta($_POST["venta"]);
	}
} else {
	header("location:mesa_admin.php");
}
?>
