<?php
	include "../conexion.php";
	$link = conectarse();
	if(mysqli_query($link,"update duda set fecha_respuesta=curdate(),respuesta='".$_POST["respuesta"]."' where id_duda=".$_POST["id_duda"])){
		header('Location: '.'dudas.php');
	}
	mysqli_close($link);
?>