<?php
	include "conexion.php";
	session_start();
	$link = conectarse();
	if(mysqli_query($link,"delete from duda where id_usuario=".$_SESSION["id_usuario"]." and id_duda=".$_GET["id_duda"])){
		header('Location: '.'dudas_usuario.php');
	}
	echo mysqli_error($link);
	mysqli_close($link);
?>