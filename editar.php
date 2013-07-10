<?php
require_once("config/funciones.php");
if ($_POST["t"]) {
	if ($_POST["t"]=="producto"){
		$tabla=$_POST["t"];
		$id=$_POST["id"];
		$producto=$_POST["producto"];
		$p_venta=$_POST["p_venta"];
		$ingrediente=$_POST["ingrediente"];
		$cantidad=$_POST["cantidad"];
		$descripcion=$_POST["descripcion"];
		$tabla=$_POST["t"];
		$f_creacion=time();
		$nombre_foto=$f_creacion;
		if (strlen($_FILES['foto']['name'])>0) {
			$foto="img/productos/$nombre_foto.".extensiones($_FILES['foto']['type']);
			copy($_FILES['foto']['tmp_name'],$foto);
			//$sql="update usuario set nombres='$nombres', email='$email',imagen='$origen' where id_usuario='".$_SESSION["usuario"]["codigo"]."'";
		}
		else {
			$sql="SELECT foto FROM producto WHERE id='$id'";
			$resultado=mysql_query($sql);
			while ($filas=mysql_fetch_assoc($resultado)) {
			$foto=$filas["foto"];
			}
		}
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
		eliminarProducto($id);
		$campos=array(
			"producto"=>$producto,
			"p_venta"=>$p_venta,
			"p_costo"=>$p_costo,
			"descripcion"=>$descripcion,
			"foto"=>$foto,
			"f_creacion"=>$f_creacion
		);
		insertar($tabla,$campos);

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
		}
		header("location:producto_admin.php");

	} elseif($_POST["t"]=="ingrediente"){
		print "hola";
		$tabla=$_POST["t"];
		$id=$_POST["id"];
		$ingrediente=strtolower(limpiarTexto($_POST["ingrediente"]));
		$costo=$_POST["costo"];
		$stock=$_POST["stock"];
		$sql="UPDATE $tabla SET ingrediente='$ingrediente', costo='$costo', stock='$stock' WHERE id='$id'";
		$resultado=mysql_query($sql);
		header("location:ingrediente_admin.php");

	}
} else {
	header("location:app_admin.php");
}
?>

