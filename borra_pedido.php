<?php
	include "conexion.php";
	session_start();
	$link = conectarse();
	if(mysqli_query($link,"delete from compra where id_usuario=".$_SESSION["id_usuario"]." and id_compra=".$_GET["id_compra"])){
		header('Location: '.'pedidos_usuario.php');
	}
	echo mysqli_error($link);
	mysqli_close($link);
?>