<?php 
session_start();
require_once("config/funciones.php");
$id_venta=$_SESSION["id_venta"];
	$sql="SELECT v.mesa, v.total_venta, v.f_venta, producto, nombre  FROM venta v INNER JOIN detalle_venta dv ON v.id=dv.id_venta INNER JOIN producto p on dv.id_producto=p.id INNER JOIN cliente c ON v.id_cliente=c.id WHERE v.id=$id_venta";
	$resultado=mysql_query($sql);+
	$detalle="";
	while ($filas=mysql_fetch_assoc($resultad)) {
		$mesa=$filas["mesa"];
		$fecha=·$filas["f_creacion"];
		$detalle.=$filas["cantidad"]." - ".$filas["producto"];
		$total_venta=$filas["total_venta"];
		$cliente=ucwords($filas["nombre"]);
	}
	$captcha=imagecreatefromjpeg("img/boleta.png");
	$color_captcha=imagecolorallocate($captcha, 0, 0, 255);
	imagestring($captcha,5,50,60,$mesa,$color_captcha);
	imagestring($captcha,3,150,100,$fecha,$color_captcha);
	imagestring($captcha,2,53,128,$detalle,$color_captcha);
	imagestring($captcha,5,50,100,$total_venta,$color_captcha);
	imagestring($captcha,3,50,143,$cliente,$color_captcha);
	header("Content-type: images/jpg");
	print "<img src='".imagejpeg($captcha)."' title='captcha'>";
?>