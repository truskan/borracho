<?php 
require_once("config/funciones.php");
//dd-mm-yyyy

print strtotime("12-12-2013");
$dia=time()-3600*24;
$sql="SELECT * FROM venta WHERE f_venta>$dia";
 print $sql;

if ($_POST){
	$dia=time()-3600*24;
	if ($_POST["tipo"]==1){
		$sql="SELECT * FROM venta WHERE f_venta>$dia";
		$resultado=mysql_query($sql);
		$mesas=array();
		$dev="";
		while ($filas=mysql_fetch_assoc($resultado)) {
			$dev.="/".$filas["mesa"]."*".$filas["total_venta"];
			
		}
		print $dev;
	}

}
?>