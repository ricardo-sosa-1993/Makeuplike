<html>
	<head>
		<meta charset="UTF-8">
		<title>Makeuplike</title>
		<link rel="shortcut icon" href="../imagenes/icono.ico" >
		<link rel="stylesheet" href="../estilos/estilos.css">
	</head>
	<body>
		<header>
				<?php
					session_start(); 
					if(!$_SESSION || !isset($_SESSION["administrador"])){
						echo "<script>location.href='iniciar_sesion.php';</script>";
					}elseif($_SESSION["administrador"]=="si"){
						echo "<div class='sesion'>
									<a href=''>Administrador: ",$_SESSION["correo_electronico"],"</a>
									<a href='../salir.php'>Cerrar sesión</a>
							</div>
							<img class ='logo' src='../imagenes/logo.png' width='200px' height='135px'>";
					}
				?>
		</header>
		<nav style="height: 76px">
				<li><a href="index.php">Inicio</a></li>
				<li> <a href="productos.php">Productos</a></li>
				<li><a href="usuarios.php">Usuarios</a></li>
				<li><a href="pedidos.php">Pedidos</a></li>
				<li><a href="dudas.php">Dudas</a></li>
				<li><a href="subcategorias.php">Subcategorias</a></li>
				<li><a href="ingresar_producto.php">Ingresar producto</a></li>
				<li><a href="ingresar_subcategoria.php">Ingresar subcategoria</a></li>
				<li><a href="agregar_administrador.php">Agregar administrador</a></li>
		</nav>
		<div class="tabla">
			<h1>Pedidos</h1>
			<table >
				<thead>
					<tr>
						<th>ID del pedido</th>
						<th>Destinatario</th>
						<th>Dirección</th>
						<th>Código postal</th>
						<th>Ciudad</th>
						<th>Estado</th>
						<th>Fecha de compra</th>
						<th>Estatus</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						include "../conexion.php";
						$link  = conectarse();
						if($link){
							$result=mysqli_query($link,"select id_compra,concat(nombre,' ',apellidos) as nombre_completo, usuario.id_usuario, activo, calle_num,colonia, codigo_postal, ciudad, estado, fecha, fecha_enviado from usuario, compra where pagado=1 and usuario.id_usuario = compra.id_usuario order by fecha");
							while($row=mysqli_fetch_array($result)){
								$direccion = $row["calle_num"]." ".$row["colonia"];
								if(is_null($row["fecha_enviado"])){
									$estatus="Pendiente";
								}else{
									$estatus="Enviado el ".$row["fecha_enviado"];
								}
								if($row["activo"]==0){
									$nombre=$row["nombre_completo"]." (Usuario eliminado)";  
								}else{
									$nombre=$row["nombre_completo"];
								}
								echo "<tr>
										<td>",$row["id_compra"],"</td>
										<td><a href='plantilla_usuario.php?id_usuario=",$row["id_usuario"],"'>",$nombre,"</a></td>
										<td>",$direccion,"</td>
										<td>",$row["codigo_postal"],"</td>
										<td>",$row["ciudad"],"</td>
										<td>",$row["estado"],"</td>
										<td>",$row["fecha"],"</td>
										<td>",$estatus,"</td>
										<td><a href='plantilla_pedido.php?id_compra=",$row["id_compra"],"'>Detalle</a></td>
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