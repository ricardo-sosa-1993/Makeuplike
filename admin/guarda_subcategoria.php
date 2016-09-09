<?php
	function guardar(){
		$link = conectarse();
		$nombre_subcategoria = $_POST["nombre_subcategoria"];
		$id_categoria = $_POST["id_categoria"];
		if($link){
			$result = mysqli_query($link,"select * from subcategoria where activo=1 and nombre_subcategoria='".$nombre_subcategoria."' and id_categoria=".$id_categoria);
			if(mysqli_num_rows($result) != 0){
				echo "<script language='javascript'>alert('Ya existe una subcategoria con ese nombre en la categoria indicada');</script>";
				}else{
					if(mysqli_query($link,"insert into subcategoria (id_categoria,nombre_subcategoria) values (".$id_categoria.",'".$nombre_subcategoria."')")){
						echo "<script language='javascript'>alert('Se ingresó la subcategoria');</script>";
					}else{
						echo mysqli_error($link);
					}
				}
				mysqli_close($link);
		}
	}
?>