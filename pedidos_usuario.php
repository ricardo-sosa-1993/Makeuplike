<html>
	<head>
		<meta charset="UTF-8">
		<title>Makeuplike</title>
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
			<h1>Pedidos realizados</h1>
			<table >
				<thead>
					<tr>
						<th>Dirección</th>
						<th>Código postal</th>
						<th>Ciudad</th>
						<th>Estado</th>
						<th>Fecha de compra</th>
						<th>Envío</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						if($link){
							$result=mysqli_query($link,"select * from compra where pagado=1 and id_usuario=".$_SESSION["id_usuario"]." order by fecha");
							while($row=mysqli_fetch_array($result)){
								$direccion = $row["calle_num"]." ".$row["colonia"];
								if(is_null($row["fecha_enviado"])){
									$estatus="Pendiente";
								}else{
									$estatus="Enviado el ".$row["fecha_enviado"];
								}
								echo "<tr>
										<td>",$direccion,"</td>
										<td>",$row["codigo_postal"],"</td>
										<td>",$row["ciudad"],"</td>
										<td>",$row["estado"],"</td>
										<td>",$row["fecha"],"</td>
										<td>",$estatus,"</td>
										<td><a href='detalle_pedido.php?id_compra=",$row["id_compra"],"'>Detalle</a></td>
									</tr>";
							}
							mysqli_close($link);
						}
		    		?>
				</tbody>
			</table>
		</div>
	</body>
</html>