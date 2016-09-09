<?php
	include "../conexion.php";
	$link = conectarse();
	if(mysqli_query($link,"delete from usuario where id_usuario='".$_GET["id_usuario"]."'")){
		header('Location: agregar_administrador.php');
	}else{
		echo mysqli_error($link);
	}
?>