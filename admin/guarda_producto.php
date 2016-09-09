<?php
	function guardar(){
		$link = conectarse();
		if($link){
			$nombre = $_POST["nombre"];
			$marca = $_POST["marca"];
			$id_subcategoria = $_POST["subcategoria"];
			$result = mysqli_query($link,"select * from producto where activo=1 and nombre='".$nombre."' and marca='".$marca."' and id_subcategoria=".$id_subcategoria."");
			if(mysqli_num_rows($result) != 0){
				echo "<script language='javascript'>alert('Ya existe ese producto con esa marca en esa categoria');</script>";
			}else{
				if(empty($_POST["tamano"])){
					$tamano="NULL";
				}else{
					$tamano="'".$_POST["tamano"]."'";
				}
				if(empty($_POST["fecha_caducidad"])){
					$fecha_caducidad="NULL";
				}else{
					$fecha_caducidad="'".$_POST["fecha_caducidad"]."'";
				}
				$target_path ="imagenes/banco_imagenes/".basename($_FILES["archivo"]["name"]);
				move_uploaded_file($_FILES["archivo"]["tmp_name"],"../".$target_path);
				if(mysqli_query($link,"insert into producto (nombre,marca,id_subcategoria,precio,tamano,fecha_caducidad,destacado,imagen,descripcion) values ('".$nombre."','".$marca."',".$id_subcategoria.",".$_POST["precio"].",".$tamano.",".$fecha_caducidad.",".$_POST["destacado"].",'".$target_path."','".$_POST["descripcion"]."')")){
					echo "<script language='javascript'>alert('Se ingresó el producto');</script>";
					}else{
						echo mysqli_error($link);
					}
			}
				mysqli_close($link);
		}
	}
?>