<?php 
session_start();
require_once("config/funciones.php");
if ($_POST["ingrediente"]) {
	if (eliminarIngrediente($_POST["ingrediente"])) {
		print eliminarIngrediente($_POST["ingrediente"]);
	}
} else {
	header("location:ingrediente_admin.php");
}
?>
