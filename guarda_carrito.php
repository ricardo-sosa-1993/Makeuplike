<?php
		include "conexion.php";
		session_start(); 
		if(!$_SESSION){
			echo "<script language='javascript'>alert('Para poder comprar necesitas iniciar sesión');</script>";
			echo "<script>location.href='iniciar_sesion.php';</script";
		}else{
			$link = conectarse();
			if($link){
				$result = mysqli_query($link,"select * from compra where pagado=0 and id_usuario=".$_SESSION["id_usuario"]);
				
				if(mysqli_num_rows($result) == 0){
					mysqli_query($link,"insert into compra(id_usuario) values (".$_SESSION["id_usuario"].")");
					}

						$result = mysqli_query($link,"select * from compra,producto_compra,producto where pagado=0 and compra.id_compra=producto_compra.id_compra and producto_compra.id_producto=producto.id_producto and producto_compra.id_producto=".$_GET["id_producto"]." and id_usuario=".$_SESSION["id_usuario"]);
						if(mysqli_num_rows($result) != 0){
							$row=mysqli_fetch_array($result);
							$cantidad_nueva = $row["cantidad"] + $_GET["cantidad"];
							$subtotal_nuevo = $row["precio"] * $cantidad_nueva;
							mysqli_query($link,"update producto_compra set cantidad=".$cantidad_nueva.", subtotal=".$subtotal_nuevo." where id_compra=".$row["id_compra"]." and id_producto=".$_GET["id_producto"]);
						}else{
							$result = mysqli_query($link,"select precio from producto where id_producto=".$_GET["id_producto"]);
								$row=mysqli_fetch_array($result);
								$subtotal_nuevo = $row["precio"] * $_GET["cantidad"];
							$result = mysqli_query($link,"select * from compra where pagado=0 and id_usuario=".$_SESSION["id_usuario"]);
								$row=mysqli_fetch_array($result);
							mysqli_query($link,"insert into producto_compra(id_compra,id_producto,cantidad,subtotal) values(".$row["id_compra"].",".$_GET["id_producto"].",".$_GET["cantidad"].",".$subtotal_nuevo.")");
						}
					mysqli_close($link);
					header('Location: '.'carrito_de_compras.php');
			}
		}

?>