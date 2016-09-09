<?php
		include "../conexion.php";
		$link = conectarse();
		if($link){
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
			if(file_exists($_FILES['archivo']['tmp_name']) || is_uploaded_file($_FILES['archivo']['tmp_name'])) {
    			$target_path ="imagenes/banco_imagenes/".basename($_FILES["archivo"]["name"]);
				move_uploaded_file($_FILES["archivo"]["tmp_name"],"../".$target_path);
					mysqli_query($link,"update producto set 
									nombre='".$_POST["nombre"]."',
									marca='".$_POST["marca"]."',
									id_subcategoria=".$_POST["subcategoria"].",
									precio=".$_POST["precio"].",
									tamano=".$tamano.",
									fecha_caducidad=".$fecha_caducidad.",
									destacado=".$_POST["destacado"].",
									imagen='".$target_path."',
									descripcion=".$_POST["descripcion"]." 
									where id_producto=".$_POST["id_producto"]);
					echo mysqli_error($link);
			}else{
				mysqli_query($link,"update producto set 
									nombre='".$_POST["nombre"]."',
									marca='".$_POST["marca"]."',
									id_subcategoria=".$_POST["subcategoria"].",
									precio=".$_POST["precio"].",
									tamano=".$tamano.",
									fecha_caducidad=".$fecha_caducidad.",
									destacado=".$_POST["destacado"].",
									descripcion='".$_POST["descripcion"]."' 
									where id_producto=".$_POST["id_producto"]);
				echo mysqli_error($link);
			}
			header('Location: '.'productos.php');
				mysqli_close($link);
		}	
?>