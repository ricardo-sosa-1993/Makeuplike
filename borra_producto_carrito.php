<?php
	include "conexion.php";
	$link = conectarse();
	if(mysqli_query($link,"delete from producto_compra where id_compra=".$_GET["id_compra"]." and id_producto=".$_GET["id_producto"])){
		header('Location: '.'carrito_de_compras.php');
	}
	echo mysqli_error($link);
	mysqli_close($link);
?>