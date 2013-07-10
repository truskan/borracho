<?php 
session_start();
require_once("variables.php");
mysql_connect($servidor,$usuario_bd,$pass_bd) or die("No hay conexion con MySQL");
mysql_select_db($bd) or die("No hay conexion con la BD");

function listarDatosPorId($tabla,$id) {
	$sql_aux="describe ".$tabla;
	$resultado_aux=mysql_query($sql_aux);
	$campos=array();
	while ($filas_aux=mysql_fetch_assoc($resultado_aux)) {
		$campos[]=$filas_aux["Field"];
	}
	$sql="SELECT * FROM ".$tabla." WHERE id='$id'";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
		foreach($campos as $item) {
			$tabla[$filas["id"]][$item]=$filas[$item];
		}
	}
	//Tabla es un array que contiene a otro array :)
	return $tabla;
}

function ejecutarConsulta($resultado=null){
	if (strlen($resultado)>0) {
		$sw=true;
	}
	else {
		$sw=false;
	}
	return $sw;
}

function limpiarTexto($texto) {
	return htmlentities(htmlspecialchars(trim($texto)));
}

function login($usuario,$clave) {
	$clave=md5($clave);
	$sql="SELECT id FROM empleado WHERE usuario='$usuario' and clave='$clave'";
	$resultado=mysql_query($sql);
	while ($filas=mysql_fetch_assoc($resultado)) {
			$id_usuario=$filas["id"];
	}
	return $id_usuario;
}

function insertar($tabla,$campos) {
	$sql="INSERT INTO $tabla (".join(', ',array_keys($campos)).") VALUES('".join("', '",$campos)."')";
	//print $sql;
	$resultado=mysql_query($sql);
}

/*
function listarDatosVariasTablas($tablas){
	foreach ($tablas as $tabla) {
		$sql_aux="describe ".$tabla;
		$resultado_aux=mysql_query($sql_aux);
		$campos=array();
		while ($filas_aux=mysql_fetch_assoc($resultado_aux)) {
			$campos[$tabla][]=$filas_aux["Field"];
		}	
	}
	$sql="SELECT * FROM ".$tabla." LIMIT 6";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
		foreach($campos as $item) {
			$tabla[$filas["id"]][$item]=$filas[$item];
		}
	}
	//Tabla es un array que contiene a otro array :)
	return $tabla;

}

select mesa, forma_pago, sum(total_venta) as totales, f_creacion, e.nombre as empleado, estado, cancelado from venta v inner join empleado e on v.id_empleado =e.id where estado=2 and cancelado=0 group by mesa order by totales desc;





*/

function rankingVentas(){
	$sql="SELECT v.id, mesa, forma_pago, sum(total_venta) as totales, v.f_venta, e.nombre as empleado, estado, cancelado FROM venta v INNER JOIN empleado e ON v.id_empleado =e.id WHERE estado=2 AND cancelado=0 GROUP BY mesa ORDER BY totales DESC";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
			$tabla[$filas["id"]]["id"]=$filas["id"];
			$tabla[$filas["id"]]["mesa"]=$filas["mesa"];
			$tabla[$filas["id"]]["forma_pago"]=$filas["forma_pago"];
			$tabla[$filas["id"]]["totales"]=$filas["totales"];
			$tabla[$filas["id"]]["f_venta"]=$filas["f_venta"];
			$tabla[$filas["id"]]["empleado"]=$filas["empleado"];
			$tabla[$filas["id"]]["estado"]=$filas["estado"];
			$tabla[$filas["id"]]["cancelado"]=$filas["cancelado"];

	}
	//Tabla es un array que contiene a otro array :)
	return $tabla;
}
function listarVentasActivas(){
	$sql="SELECT v.id, mesa, total_venta, f_venta, c.nombre as cliente, e.nombre as empleado FROM venta v INNER JOIN detalle_venta d ON v.id=d.id_venta INNER JOIN cliente c ON v.id_cliente=c.id INNER JOIN empleado e ON v.id_empleado =e.id INNER JOIN producto p ON d.id_producto = p.id WHERE v.estado=1 and v.cancelado=0 group by v.id";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
			$tabla[$filas["id"]]["mesa"]=$filas["mesa"];
			$tabla[$filas["id"]]["total_venta"]=$filas["total_venta"];
			$tabla[$filas["id"]]["f_venta"]=$filas["f_venta"];
			$tabla[$filas["id"]]["cliente"]=$filas["cliente"];
			$tabla[$filas["id"]]["empleado"]=$filas["empleado"];
	}
	return $tabla;
}	


function listarProductoInicial($id_tiempo,$foto){
	$sql="SELECT id from producto where f_creacion='$id_tiempo' and foto='$foto'";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
			$tabla[]=$filas["id"];
	}
	return $tabla;
}

function listarVentaInicial($id_tiempo,$mesa) {
	$sql="SELECT id from venta where f_venta='$id_tiempo' and mesa='$mesa'";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
			$tabla[]=$filas["id"];
	}
	return $tabla;
}

function listarClienteExistente($nombre){
	$sql="SELECT id FROM cliente where nombre='$nombre'";
	$resultado=mysql_query($sql);
	if (mysql_num_rows($resultado)>0){
		while ($filas=mysql_fetch_assoc($resultado)){
			$id=$filas["id"];
		}
		return $id;
	} 
}


//campo es un array diccionario

function listarDetalleVenta($id_venta){

	$sql="SELECT d.id, d.cantidad,p.p_venta,p.producto FROM detalle_venta d INNER JOIN producto p ON d.id_producto=p.id WHERE d.id_venta='$id_venta'";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
			$tabla[$filas["id"]]["cantidad"]=$filas["cantidad"];
			$tabla[$filas["id"]]["p_venta"]=$filas["p_venta"];
			$tabla[$filas["id"]]["producto"]=$filas["producto"];
	}
	return $tabla;
}

function mesasLibres($mesas_len){
	$sql="SELECT mesa FROM venta WHERE estado=1";
	$resultado=mysql_query($sql);
	$mesas_libres=array();
	$mesas_ocupadas=array();
	while($filas=mysql_fetch_assoc($resultado)){
		$mesas_ocupadas[]=$filas["mesa"];
	}
	for ($i=1; $i < $mesas_len+1; $i++) { 
		if (!(in_array($i,$mesas_ocupadas))) {
			$mesas_libres[]=$i;
		}
	}
	return $mesas_libres;
}


function listarDatosPorCampoUnico($tabla,$campo){
	$sql_aux="describe ".$tabla;
	$resultado_aux=mysql_query($sql_aux);
	$campos=array();
	while ($filas_aux=mysql_fetch_assoc($resultado_aux)) {
		$campos[]=$filas_aux["Field"];
	}
	
	$sql="SELECT * FROM ".$tabla." WHERE ".array_keys($campo)[0]."='".$campo[array_keys($campo)[0]]."' group by ".array_keys($campo)[0];
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
		foreach($campos as $item) {
			$tabla[$filas["id"]][$item]=$filas[$item];
		}
	}
	//Tabla es un array que contiene a otro array :)
	return $tabla;

}

function terminarVenta($id_venta){
	$sql="UPDATE venta set estado=2 WHERE id='$id_venta'";
	$resultado=mysql_query($sql);
	return true;
}

function cancelarVenta($id_venta){
	$sql="UPDATE venta set cancelado=1, estado=2 WHERE id='$id_venta'";
	$resultado=mysql_query($sql);
	return true;
}

function listarDatos($tabla) {
	$sql_aux="describe ".$tabla;
	$resultado_aux=mysql_query($sql_aux);
	$campos=array();
	while ($filas_aux=mysql_fetch_assoc($resultado_aux)) {
		$campos[]=$filas_aux["Field"];
	}
	$sql="SELECT * FROM ".$tabla;
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
		foreach($campos as $item) {
			$tabla[$filas["id"]][$item]=$filas[$item];
		}
	}
	//Tabla es un array que contiene a otro array :)
	return $tabla;
}

function extensiones($ext){
	$extension=array(
		"image/jpg"=>"jpg",
		"image/png"=>"png",
		"image/gif"=>"gif",
		"image/jpeg"=>"jpeg"
	);
	return $extension[$ext];
}



function listarIngrediente($id_producto){
	$sql="SELECT d.id,i.id as id_ingrediente, d.cantidad,ingrediente FROM detalle_plato d INNER JOIN ingrediente i on d.id_ingrediente=i.id WHERE d.id_producto='$id_producto'";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
			$tabla[$filas["id"]]["id"]=$filas["id"];
			$tabla[$filas["id"]]["id_ingrediente"]=$filas["id_ingrediente"];
			$tabla[$filas["id"]]["ingrediente"]=$filas["ingrediente"];
			$tabla[$filas["id"]]["cantidad"]=$filas["cantidad"];
	}
	return $tabla;
}
function listarTodosIngredientes(){
	$sql_aux="describe ingrediente";
	$resultado_aux=mysql_query($sql_aux);
	$campos=array();
	while ($filas_aux=mysql_fetch_assoc($resultado_aux)) {
		$campos[]=$filas_aux["Field"];
	}
	$sql="SELECT id,ingrediente FROM ingrediente";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
		foreach($campos as $item) {
			$tabla[$filas["id"]][$item]=$filas[$item];
		}
	}
	return $tabla;	

}

function eliminarProducto($id_producto){
	$sql="DELETE FROM producto WHERE id='$id_producto'";
	$resultado=mysql_query($sql);
	return true;
}
function eliminarIngrediente($id_ingrediente){
	$sql="DELETE FROM ingrediente WHERE id='$id_ingrediente'";
	$resultado=mysql_query($sql);
	return true;
}


function buscarPrecioIngrediente($id_ingrediente){
	$sql="SELECT id,costo FROM ingrediente where id='$id_ingrediente'";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
			$tabla[$filas["id"]]["costo"]=$filas["costo"];
	}
	return $tabla;
}

function buscarPrecioVenta($id_producto){
	$sql="SELECT id,p_venta FROM producto where id='$id_producto'";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
			$tabla[$filas["id"]]["p_venta"]=$filas["p_venta"];
	}
	return $tabla;
}


function listarVentas() {
	$sql_aux="describe venta";
	$resultado_aux=mysql_query($sql_aux);
	$campos=array();
	while ($filas_aux=mysql_fetch_assoc($resultado_aux)) {
		$campos[]=$filas_aux["Field"];
	}
	$sql="SELECT * FROM venta WHERE estado=1 GROUP BY mesa";
	$resultado=mysql_query($sql);
	$tabla=array();
	while ($filas=mysql_fetch_assoc($resultado)) {
		foreach($campos as $item) {
			$tabla[$filas["id"]][$item]=$filas[$item];
		}
	}

	//Tabla es un array que contiene a otro array :)
	return $tabla;
}



?>
