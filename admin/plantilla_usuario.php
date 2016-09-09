<html>
	<head>
		<meta charset="UTF-8">
		<title>Makeuplike</title>
		<link rel="shortcut icon" href="../imagenes/icono.ico" >
		<link rel="stylesheet" href="../estilos/estilos.css">
		<script language='javascript'>
			function verifica(){
				var r=window.confirm('¿Estas seguro que quieres borrar el usuario?');
				var id_usuario=<?php echo $_GET["id_usuario"]; ?>;
					if(r)
						location.href='borra_usuario.php?id_usuario='+id_usuario;
					}
	</script>
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
		<ul class="breadcrumb">
			<li><a href="usuarios.php">Usuarios</a></li>
			<li>Datos de usuario</li>
		</ul>
		<div class="tabla">
			<h1>Datos de usuario</h1>
			<table>
				<tbody>
					<?php
						include "../conexion.php";
						$link  = conectarse();
						if($link){
							$consulta = "select * from usuario where id_usuario=".$_GET["id_usuario"];
							$result=mysqli_query($link,$consulta);
							$row=mysqli_fetch_array($result);
								echo "<tr>
										<td>Nombre:</td>
										<td>",$row["nombre"],"</td>
									</tr>
									<tr>
										<td>Apellidos:</td>
										<td>",$row["apellidos"],"</td>
									</tr>
									<tr>
										<td>Fecha de nacimiento:</td>
										<td>",$row["fecha_nacimiento"],"</td>
									</tr>
									<tr>
										<td>Teléfono:</td>
										<td>",$row["telefono"],"</td>
									</tr>
									<tr>
										<td>Correo electrónico:</td>
										<td>",$row["correo_electronico"],"</td>
									</tr>
									<tr>
										<td colspan='2'><button type='button' onclick='verifica()'>Eliminar</button></td>
									</tr>";
							
							mysqli_close($link);
						}
		    		?>
				</tbody>
			</table>
		</div>
		<div class="tabla">
			<h1>Pedidos</h1>
			<table >
				<thead>
					<tr>
						<th>ID del pedido</th>
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
						$link  = conectarse();
						if($link){
							$result=mysqli_query($link,"select * from usuario, compra where pagado=1 and compra.id_usuario=".$_GET["id_usuario"]." and usuario.id_usuario = compra.id_usuario order by fecha");
							while($row=mysqli_fetch_array($result)){
								$direccion = $row["calle_num"]." ".$row["colonia"];
								if(is_null($row["fecha_enviado"])){
									$estatus="Pendiente";
								}else{
									$estatus="Enviado el ".$row["fecha_enviado"];
								}
								echo "<tr>
										<td>",$row["id_compra"],"</td>
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