<?php
require_once("config/funciones.php");
if($_POST){
	$mesa=$_POST["mesa"];
	$cliente=limpiarTexto(strtolower($_POST["cliente"]));

	if(listarClienteExistente($cliente)) {
		$id_cliente=listarClienteExistente($cliente);
	} else {
		$campos=array(
			"nombre"=>$cliente,
			"ruc"=>"",
			"f_creacion"=>time()
		);
		insertar("cliente",$campos);
		$id_cliente=listarClienteExistente($cliente);
	}
	$productos=$_POST["producto"];
	$cantidades=$_POST["cantidad"];
	$forma_pago=1;
	$i=0;
	$total=0;
	foreach ($productos as $item) {
		$producto=buscarPrecioVenta($item);
		$total+=$producto[$item]["p_venta"]*$cantidades[$i];
		$i++;
	}
	$total_venta=$total;
	$empleado=$_SESSION["id_usuario"];
	//Insertar datos en Detalle ingrediente
	$f_venta=time();
	$id_tiempo=$f_venta;
	$campos=array(
		"forma_pago"=>1,
		"mesa"=>$mesa,
		"total_venta"=>$total_venta,
		"f_venta"=>$f_venta,
		"id_cliente"=>$id_cliente,
		"id_empleado"=>$empleado,
		"estado"=>1,
		"cancelado"=>0
	);
	insertar("venta",$campos);
	//print_r($campos);
	$venta=listarVentaInicial($id_tiempo,$mesa);
	foreach ($venta as $item) {
		$id_venta=$item;
	}
	$i=0;
	foreach ($productos as $item) {
		$campos=array(
			"id_venta"=>$id_venta,
			"cantidad"=>$cantidades[$i],
			"id_producto"=>$item
		);	
		insertar("detalle_venta",$campos);
		$i++;
	}
	//print_r($campos);
	header("location:mesa_admin_actual.php");

}else {
	header("location:app_admin.php");
}

?>