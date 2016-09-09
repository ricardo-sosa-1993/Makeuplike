<?php
	include "../conexion.php";
	$link = conectarse();
	$result=mysqli_query($link,"select * from producto where id_subcategoria=".$_GET["id_subcategoria"]);
	while($row=mysqli_fetch_array($result)){
		mysqli_query($link,"update producto set  activo=0 where id_producto=".$row["id_producto"]);
		mysqli_query($link,"delete producto_compra from producto_compra,compra where pagado=0 and id_producto=".$row["id_producto"]);
	}
	mysqli_query($link,"update subcategoria set activo=0 where id_subcategoria=".$_GET["id_subcategoria"]);
	mysqli_close($link);
	header("Location: subcategorias.php");
?>