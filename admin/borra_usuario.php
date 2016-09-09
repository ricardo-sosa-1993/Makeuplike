<?php
	include "../conexion.php";
	$link = conectarse();
	if(mysqli_query($link,"update usuario set activo=0 where id_usuario=".$_GET["id_usuario"])){
		header('Location: '.'usuarios.php');
	}
	mysqli_close($link);
?>