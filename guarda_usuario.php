<?php
	function guardar(){
		$link = conectarse();
		if($link){
			$result = mysqli_query($link,"select * from usuario where correo_electronico='".$_POST["correo_electronico"]."'");
			if(mysqli_num_rows($result) != 0){
				echo "<script language='javascript'>alert('Ya existe una cuenta vinculada a ese correo electrónico');</script>";
				}else{
						if(mysqli_query($link,"insert into usuario (nombre,apellidos,fecha_nacimiento,telefono,correo_electronico,contrasena) values ('".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["ano"]."/".$_POST["mes"]."/".$_POST["dia"]."','".$_POST["telefono"]."','".$_POST["correo_electronico"]."','".$_POST["contrasena"]."')")){
							echo "<script language='javascript'>alert('Creaste una cuenta. Ahora puedes iniciar sesión.');</script>";
							echo "<script>location.href='iniciar_sesion.php';</script";
						}				
				}
				mysqli_close($link);
		}
	}
?>