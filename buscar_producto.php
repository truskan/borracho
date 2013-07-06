<?php
require_once("config/funciones.php");
$patron=$_POST["patron"];
$sql="select * from producto where id='".$patron."'";
$resultado=mysql_query($sql);
$costo="";
while ($filas=mysql_fetch_assoc($resultado)) {
	$costo=$filas["p_venta"];
}
print $costo;
?>
