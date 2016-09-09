<?php
	include "../conexion.php";
	$link = conectarse();
	if(mysqli_query($link,"delete from compra where id_compra=".$_GET["id_compra"])){
		header('Location: '.'pedidos.php');
	}
	echo mysqli_error($link);
	mysqli_close($link);
?>