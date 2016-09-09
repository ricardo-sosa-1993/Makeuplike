<html>
	<head>
		<meta charset="UTF-8">
		<title>Makeuplike</title>
		<link rel="shortcut icon" href="imagenes/icono.ico" >
		<link rel="stylesheet" href="estilos/estilos.css">
		<script language='javascript'>
			function cancelar(){
				var r=window.confirm('¿Estas seguro que quieres cancelar el pedido?');
				var id_compra=<?php echo $_GET["id_compra"]; ?>;
					if(r)
						location.href='borra_pedido.php?id_compra='+id_compra;
					}
		</script>
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
			<h1>Datos de pedido</h1>
			<table>
				<tbody>
					<?php
						$link  = conectarse();
						if($link){
							$id_compra=$_GET["id_compra"];
							$consulta = "select * from compra where id_compra=".$id_compra;
							$result=mysqli_query($link,$consulta);
							$row=mysqli_fetch_array($result);
							if(is_null($row["fecha_enviado"])){
									$estatus="Pendiente";
									$editar="<a href='editar_pedido.php?id_compra=".$row["id_compra"]."'>Editar datos de envío</a>";
									$cancelar="<button onclick='cancelar()'>Cancelar pedido</button>";
								}else{
									$estatus="Enviado el ".$row["fecha_enviado"];
									$editar="";
									$cancelar="";
								}
								echo "
									<tr>
										<td>Fecha de compra:</td>
										<td>",$row["fecha"],"</td>
									</tr>
									<tr>
										<td>Calle y número:</td>
										<td>",$row["calle_num"],"</td>
									</tr>
									<tr>
										<td>Colonia:</td>
										<td>",$row["colonia"],"</td>
									</tr>
									<tr>
										<td>Ciudad:</td>
										<td>",$row["ciudad"],"</td>
									</tr>
									<tr>
										<td>Estado:</td>
										<td>",$row["estado"],"</td>
									</tr>
									<tr>
										<td>Código postal:</td>
										<td>",$row["codigo_postal"],"</td>
									</tr>
									<tr>
										<td>Estatus:</td>
										<td>",$estatus,"</td>
									</tr>
									<tr>
										<td>",$editar,"</td>
										<td>",$cancelar,"</td>
									</tr>
									</tbody>
									</table>
									</div>
									<div class='tabla'>
									<h1>Productos del pedido</h1>
									<table>
									<thead>
										<tr>
											<th>ID del producto</th>
											<th>Nombre del producto</th>
											<th>Precio unitario</th>
											<th>Cantidad</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										";
									$consulta = "select * from producto,producto_compra where id_compra=".$id_compra." and producto.id_producto=producto_compra.id_producto";
									$result=mysqli_query($link,$consulta);
									$total = 0;
							while($row=mysqli_fetch_array($result)){
								$total = $total + $row["subtotal"];
								echo "
										<tr>
											<td>",$row["id_producto"],"</td>
											<td><a href='plantilla_producto.php?id_producto=",$row["id_producto"],"'>",$row["marca"]," - ",$row["nombre"],"</a></td>
											<td>$",$row["precio_unitario"],"</td>
											<td>",$row["cantidad"],"</td>
											<td>$",$row["subtotal"],"</td>
										</tr>
									";
							}
							echo "
									</tbody>
									<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th>Total</th>
												<th>$",$total,"</th>
											</tr>
										</tfoot>
									</table>
									</div>
									";
							
							mysqli_close($link);
						}
		    		?>
	</body>