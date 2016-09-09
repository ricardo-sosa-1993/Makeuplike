<html>
	<head>
		<meta charset="UTF-8">
		<title>Carrito de compras</title>
		<link rel="shortcut icon" href="imagenes/icono.ico" >
		<link rel="stylesheet" href="estilos/estilos.css">
	</head>
	<body>
		<header>
				<?php
					session_start(); 
					if(!$_SESSION){
						echo "<script language='javascript'>alert('Tienes que iniciar sesión');</script>";
						echo "<script>location.href='iniciar_sesion.php';</script>";
					}else{
						echo "<div class='sesion'>
								<a class='carro'href='carrito_de_compras.php'><img src='imagenes/carrito_de_compras.png'> Carrito de compras</a>
								<a href='opciones_usuario.php'>",$_SESSION["correo_electronico"],"</a>
								<a href='salir.php'>Cerrar sesión</a>
								</div>";
					}
				?>
				<a href="index.php"><img class ="logo" src="imagenes/logo.png" width="200px" height="135px"></a>
		</header>
		<nav>
				<li><a href="index.php">Inicio</a></li>
				<?php
					include "conexion.php";
					$link = conectarse();
					if($link){
						$result=mysqli_query($link,"select * from categoria where activo=1");
						while($row=mysqli_fetch_array($result)){
							echo "<li>",$row["nombre_categoria"],"
									<ul>";
							$result2 = mysqli_query($link,"select * from subcategoria where activo=1 and id_categoria = ".$row["id_categoria"]);
							while($row2=mysqli_fetch_array($result2)){
								echo "<li><a href='plantilla_subcategoria.php?id_subcategoria=",$row2["id_subcategoria"],"'>",$row2["nombre_subcategoria"],"</a></li>";
							}
							echo "  </ul>
								 </li>";
						}
						
					}
				?>
				<div class="busqueda">
					<form action="buscar.php" method="get">
						<input type="search" name="busqueda" placeholder="Término de búsqueda"/>
						<input type="image" src="imagenes/lupa.png"  alt="Submit" />
					</form>
				</div>
		</nav>
		<div class="tabla">
			<h1>Carrito de compras</h1>
			<table>
				<thead>
					<tr>
						<th>Nombre del producto</th>
						<th>Cantidad</th>
						<th>Precio unitario</th>
						<th>Subtotal</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$link  = conectarse();
						if($link){
							$total=0;
							$i=0;
							$result=mysqli_query($link,"select * from compra,producto_compra,producto where pagado=0 and compra.id_compra=producto_compra.id_compra and producto_compra.id_producto=producto.id_producto and id_usuario=".$_SESSION["id_usuario"]);
							while($row=mysqli_fetch_array($result)){
								$id_compra=$row["id_compra"];
								$total+=$row["subtotal"];
								$i++;
								echo "
									<script type='text/javascript'>
										function cambiaCantidad",$i,"(){
											var cantidad = document.getElementById('cantidad",$i,"');
											location.href='actualiza_carrito.php?id_producto=",$row["id_producto"],"&cantidad='+cantidad.value;
										}
									</script>
									<tr>
										<td><a href='plantilla_producto.php?id_producto=",$row["id_producto"],"'>",$row["marca"]," - ",$row["nombre"],"</a></td>
										<td><input id='cantidad",$i,"' type='number' min='1' max='5' value='",$row["cantidad"],"'' onchange='cambiaCantidad",$i,"()'/></td>
										<td>$",$row["precio"],"</td>
										<td>$",$row["subtotal"],"</td>
										<td><a href='borra_producto_carrito.php?id_compra=",$row["id_compra"],"&id_producto=",$row["id_producto"],"'>Eliminar</a></td>
									</tr>";
							}
							echo "<tr>
									<th></th>
									<th></th>
									<th>Total</th>
									<th>$",$total,"</th>
									<th></th>
								</tr>";
							mysqli_close($link);
						}
		    		?>
				</tbody>
			<tr>
				<td colspan="5">
				<a href="pagar.php?id_compra=<?php echo $id_compra; ?>" style="float:right" type="button">Pagar</a>
				</td>
			</tr>
			</table>
		</div>
	</body>
</html>