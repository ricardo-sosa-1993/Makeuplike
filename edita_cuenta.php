<?php
	include "conexion.php";
	session_start(); 
	$link=conectarse();
	$result=mysqli_query($link,"select * from usuario where id_usuario!=".$_SESSION["id_usuario"]." and correo_electronico='".$_POST["correo_electronico"]."'");
	if(mysqli_num_rows($result)==0){
		mysqli_query($link,"update usuario set nombre='".$_POST["nombre"]."', apellidos='".$_POST["apellidos"]."', fecha_nacimiento='".$_POST["ano"]."/".$_POST["mes"]."/".$_POST["dia"]."',telefono='".$_POST["telefono"]."',correo_electronico='".$_POST["correo_electronico"]."' where id_usuario=".$_SESSION["id_usuario"]);
		echo "<script>
					alert('Se han actualizado los datos');
		        	location.href= 'opciones_usuario.php';
			  </script>";
	}else{
		echo "<script>
				alert('Ya existe una cuenta vinculada ese correo electrónico');
				location.href='editar_cuenta.php';
			  </script>";
	}
?>