<?php 
$servidor="localhost";
$usuario_bd="root";
$pass_bd="toor";
$bd="borracho";


// Categorias con respecto a productos

$categorias=array("1"=>"perecible","2"=>"no perecible");
$estrella=array("1"=>"plato estrella","2"=>"plato asiduo");
$carousel_len=6;
$mesas_len=15;
$forma_venta=array("1"=>"efectivo","2"=>"tarjeta");

$reporte_tipo=array("1"=>"diario","2"=>"semanal","3"=>"mensual","4"=>"anual","5"=>"fecha especifica");

//Variables de la Venta
$estado=array("1"=>"en proceso","2"=>"finalizado");
$estado_in=array("1"=>"perecible","2"=>"no perecible");
$cancelado=["0"=>"no","1"=>"si"];
$dias_disponible=3600*24*15;
$meses=array(
	"Enero",
	"Febrero",
	"Marzo",
	"Abril",
	"Mayo",
	"Junio",
	"Julio",
	"Agosto",
	"Setiembre",
	"Octubre",
	"Noviembre",
	"Diciembre"
);

?>