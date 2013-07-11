<?php 
session_start();
require_once("config/funciones.php");
if ($_POST["venta"]) {
	if (terminarVenta($_POST["venta"])) {
		$id_venta=$_POST["venta"];
		$_SESSION["id_venta"]=$_POST["id_venta"];
		$sql="SELECT dv.cantidad as c_venta, dp.cantidad as c_plato , i.id AS id_ingrediente, i.stock, i.costo FROM detalle_venta dv INNER JOIN detalle_plato dp ON dv.id_producto = dp.id_producto INNER JOIN ingrediente i ON dp.id_ingrediente = i.id WHERE id_venta=$id_venta";
		$resultado=mysql_query($sql);
		while ($filas=mysql_fetch_assoc($resultado)) {
			//$descuento=$filas["costo"]*$filas["cantidad"]/$filas["stock"];
			$cantidad=$filas["c_plato"]*$filas["c_venta"];
			$sql1="UPDATE ingrediente SET stock=stock-$cantidad where id='".$filas["id_ingrediente"]."'";
			$resultado1=mysql_query($sql1);
		}
		print terminarVenta($_POST["venta"]);
	}
} else {
	header("location:mesa_admin.php");
}
?>
