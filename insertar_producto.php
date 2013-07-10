<?php
require_once("config/funciones.php");
if($_POST){
	$producto=limpiarTexto(strtolower($_POST["producto"]));
	$p_venta=$_POST["p_venta"];
	$categoria=$_POST["categoria"];
	$descripcion=$_POST["descripcion"];
	$estrella=$_POST["estrella"];
	$ingrediente=$_POST["ingrediente"];
	$cantidad=$_POST["cantidad"];
	$f_creacion=time();
	$nombre_foto=time();
	if (strlen($_FILES['foto']['name'])>0) {
		$foto="img/productos/$nombre_foto.".extensiones($_FILES['foto']['type']);
		copy($_FILES['foto']['tmp_name'],$foto);
		//$sql="update usuario set nombres='$nombres', email='$email',imagen='$origen' where id_usuario='".$_SESSION["usuario"]["codigo"]."'";
	}
	else {
		$foto="img/productos/default.png";
	}

	//falta p_costo

	$i=0;
	$total=0;
	//print_r($ingrediente);
	foreach ($ingrediente as $item) {
		$ingredientes=buscarPrecioIngrediente($item);
		//print_r($ingrediente);
		$total+=$ingredientes[$item]["costo"]*$cantidad[$i];
		$i++;
	}
	$p_costo=$total;
	$campos=array(
		"producto"=>$producto,
		"p_venta"=>$p_venta,
		"p_costo"=>$p_costo,
		"categoria"=>$categoria,
		"descripcion"=>$descripcion,
		"foto"=>$foto,
		"estrella"=>$estrella,
		"f_creacion"=>$f_creacion
	);
	insertar("producto",$campos);

	//print_r($campos);
	$id_tiempo=$f_creacion;
	$productos=listarProductoInicial($id_tiempo,$foto);
	foreach ($productos as $item) {
		$id_producto=$item;
	}
	$i=0;
	foreach ($ingrediente as $item) {
		$campos=array(
			"id_producto"=>$id_producto,
			"id_ingrediente"=>$item,
			"cantidad"=>$cantidad[$i]
		);	
		insertar("detalle_plato",$campos);
		$i++;
	}
	
	header("location:producto_admin.php");

}else {
	header("location:app_admin.php");
}

?>