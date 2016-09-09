<?php
	include "../conexion.php";
	$link = conectarse();
	if(mysqli_query($link,"update compra set fecha_enviado='".$_GET["ano"]."/".$_GET["mes"]."/".$_GET["dia"]."' where id_compra=".$_GET["id_compra"])){
		header('Location: '.'plantilla_pedido.php?id_compra='.$_GET["id_compra"]);
	}
	mysqli_close($link);
?>