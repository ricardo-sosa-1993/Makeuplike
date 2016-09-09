<?php
	include "../conexion.php";
	$link = conectarse();
	if(mysqli_query($link,"delete from duda where id_duda=".$_GET["id_duda"])){
		header('Location: '.'dudas.php');
	}
	echo mysqli_error($link);
	mysqli_close($link);
?>