<?php
	include "conexion.php";
	session_start();
	$link=conectarse();
	if(mysqli_query($link,"insert into duda(id_usuario,contenido,fecha_pregunta) values (".$_SESSION["id_usuario"].",'".$_POST["contenido"]."',curdate())")){
		header('Location: '.'dudas_usuario.php');
	}
?>