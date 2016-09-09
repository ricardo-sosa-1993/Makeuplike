<?php
	include "../conexion.php";
	$link = conectarse();
	if(mysqli_query($link,"update producto set activo=0 where id_producto=".$_GET["id_producto"])){
		mysqli_query($link,"delete from producto_compra where pagado=0 and id_producto=".$_GET["id_producto"]);
		header('Location: '.'productos.php');
	}
	mysqli_close($link);
?>