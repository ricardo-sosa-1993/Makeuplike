<?php
		include "conexion.php";
		session_start(); 
		if(!$_SESSION){
			echo "<script language='javascript'>alert('Para poder comprar necesitas iniciar sesión');</script>";
			echo "<script>location.href='iniciar_sesion.php';</script";
		}else{
			$link = conectarse();
			if($link){

						$result = mysqli_query($link,"select * from compra,producto_compra,producto where pagado=0 and compra.id_compra=producto_compra.id_compra and producto_compra.id_producto=producto.id_producto and producto_compra.id_producto=".$_GET["id_producto"]." and id_usuario=".$_SESSION["id_usuario"]);
						echo mysqli_error($link);
						if(mysqli_num_rows($result) != 0){
							$row=mysqli_fetch_array($result);
							$subtotal_nuevo = $row["precio"] * $_GET["cantidad"];
							mysqli_query($link,"update producto_compra set cantidad=".$_GET["cantidad"].", subtotal=".$subtotal_nuevo." where id_compra=".$row["id_compra"]." and id_producto=".$_GET["id_producto"]);
						}
					mysqli_close($link);
					header('Location: '.'carrito_de_compras.php');
			}
		}

?>