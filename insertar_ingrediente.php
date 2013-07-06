<?php
require_once("config/funciones.php");
if($_POST){
	$ingrediente=limpiarTexto(strtolower($_POST["ingrediente"]));
	$costo=$_POST["costo"];
	$stock=$_POST["stock"];
	$f_compra=time();
	$f_vencimiento=time()+$dias_disponible;
	$estado=1;

	$campos=array(
		"ingrediente"=>$ingrediente,
		"costo"=>$costo,
		"stock"=>$stock,
		"f_compra"=>$f_compra,
		"f_vencimiento"=>$f_vencimiento,
		"estado"=>$estado
	);
	insertar("ingrediente",$campos);
	
	header("location:ingrediente_admin.php");

}else {
	header("location:app_admin.php");
}

?>