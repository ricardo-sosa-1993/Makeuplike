<?php
	include "conexion.php";
	$link = conectarse(); 
	$result = mysqli_query($link,"select * from usuario where activo=1 and correo_electronico='".$_POST["correo"]."' and contrasena='".$_POST["contrasena"]."'");
	if(mysqli_num_rows($result) != 0){
	    $row=mysqli_fetch_array($result);
	    session_start(); 
	    $_SESSION["correo_electronico"]= $_POST["correo"]; 
	    $_SESSION["id_usuario"]= $row["id_usuario"];
	    header ("Location: index.php"); 
 	}else{
 		echo "<script language='javascript'>alert('Datos incorrectos');</script>";
		echo "<script>location.href='iniciar_sesion.php';</script>";
 	}
 	mysqli_close($link);
?>