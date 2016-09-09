<?php
	include "conexion.php";
	$link = conectarse();
	if(mysqli_query($link,"update compra set pagado=1,fecha=curdate(),calle_num='".$_POST["calle_num"]."',colonia='".$_POST["colonia"]."',ciudad='".$_POST["ciudad"]."',estado='".$_POST["estado"]."',codigo_postal='".$_POST["codigo_postal"]."' where id_compra=".$_POST["id_compra"])){
		$result = mysqli_query($link,"select * from producto_compra where id_compra=".$_POST["id_compra"]);
		while($row=mysqli_fetch_array($result)){
			$result2=mysqli_query($link,"select * from producto where id_producto=".$row["id_producto"]);
			$row2=mysqli_fetch_array($result2);
			$subtotal = $row["cantidad"] * $row2["precio"]; 
			mysqli_query($link,"update producto_compra set precio_unitario=".$row2["precio"].", subtotal=".$subtotal." where id_compra=".$row["id_compra"]." and id_producto=".$row["id_producto"]);
		}
		echo "<script language='javascript'>alert('Tu compra ha sido concretada.');</script>";
		echo "<script language='javascript'>location.href='pedidos_usuario.php';</script>";
	}
	mysqli_close($link);
?>