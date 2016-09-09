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
			<h1>Usuarios</h1>
			<table>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Fecha de nacimiento</th>
						<th>Teléfono</th>
						<th>Correro Electrónico</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						include "../conexion.php";
						$link  = conectarse();
						if($link){
							$result=mysqli_query($link,"select id_usuario,concat(nombre,' ',apellidos) as nombre_completo, fecha_nacimiento, telefono, correo_electronico from usuario where activo=1 and administrador=0");
							while($row=mysqli_fetch_array($result)){
								echo "<tr>
										<td>",$row["nombre_completo"],"</td>
										<td>",$row["fecha_nacimiento"],"</td>
										<td>",$row["telefono"],"</td>
										<td>",$row["correo_electronico"],"</td>
										<td><a href='plantilla_usuario.php?id_usuario=",$row["id_usuario"],"'>Detalle</a></td>
									</tr>";
							}
							mysqli_close($link);
						}
		    		?>
				</tbody>
			</table>
		</div>
	</body>