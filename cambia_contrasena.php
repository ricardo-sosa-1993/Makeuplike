<?php
	include "conexion.php";
	$link=conectarse();
	session_start();
	$result=mysqli_query($link,"select * from usuario where contrasena='".$_POST["contrasena_antigua"]."' and id_usuario=".$_SESSION["id_usuario"]);
	if(mysqli_num_rows($result)!=0){
		if($_POST["contrasena_nueva1"]==$_POST["contrasena_nueva2"]){
			mysqli_query($link,"update usuario set contrasena='".$_POST["contrasena_nueva1"]."' where id_usuario=".$_SESSION["id_usuario"]);
			echo "<script>
						alert('Se ha cambiado la contraseña');
						location.href='opciones_usuario.php';
				  </script>";

		}else{
			echo "<script>
						alert('Las contraseñas ingresadas no coinciden');
						location.href='cambiar_contrasena.php';
			      </script>";
	}
	}else{
		echo "<script>
					alert('La contraseña actual ingresada es incorrecta');
					location.href='cambiar_contrasena.php';
			  </script>";
	}
	
?>