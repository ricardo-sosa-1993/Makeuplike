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
		<div clas="tabla" action="productos.php" method="get">
			<table>
			 	<tr>
			 	<form>
			 		<td>Buscar por nombre, categoría o subcategoría</td>
			 		<td><input type="search" name="busqueda" placeholder="Término de búsqueda"/></td>
			 		<td><input type="submit" value="Buscar"></td>
			 	</form>
				 </tr>
			</table>
		</div>
		<div class="tabla">
			<h1>Productos</h1>
			<table>
				<thead>
					<tr>
						<th>ID del producto</th>
						<th>Nombre</th>
						<th>Marca</th>
						<th>Categoria</th>
						<th>Subcategoria</th>
						<th>Precio unitario</th>
						<th>Destacado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						include "../conexion.php";
						$link  = conectarse();
						if($link){
							$result=mysqli_query($link," select id_producto,nombre,marca, nombre_categoria, nombre_subcategoria, precio, destacado from producto,subcategoria,categoria where producto.id_subcategoria=subcategoria.id_subcategoria and subcategoria.id_categoria=categoria.id_categoria and producto.activo=1;");
							if($_GET){
								$busqueda = $_GET["busqueda"];
								if($busqueda !== ''){
									while($row=mysqli_fetch_array($result)){

										if ((strpos(strtolower($row["nombre"]), strtolower($busqueda)) !== false) ||
											(strpos(strtolower($row["marca"]), strtolower($busqueda)) !== false) ||
											(strpos(strtolower($row["nombre_subcategoria"]),strtolower($busqueda)) !== false) ||
											(strpos(strtolower($row["nombre_categoria"]),strtolower($busqueda)) !== false)){
							
											if($row["destacado"]==0){
											$destacado=" ";
										}else{
											$destacado="&#10004;";
										}
										echo "<tr>
												<td>",$row["id_producto"],"</td>
												<td>",$row["nombre"],"</td>
												<td>",$row["marca"],"</td>
												<td>",$row["nombre_categoria"],"</td>
												<td>",$row["nombre_subcategoria"],"</td>
												<td>",$row["precio"],"</td>
												<td>",$destacado,"</td>
												<td><a href='plantilla_producto.php?id_producto=",$row["id_producto"],"'>Detalle</a></td>
											</tr>";
									
											}
										}
								}
							}else{
								while($row=mysqli_fetch_array($result)){
									if($row["destacado"]==0){
										$destacado=" ";
									}else{
										$destacado="&#10004;";
									}
									echo "<tr>
											<td>",$row["id_producto"],"</td>
											<td>",$row["nombre"],"</td>
											<td>",$row["marca"],"</td>
											<td>",$row["nombre_categoria"],"</td>
											<td>",$row["nombre_subcategoria"],"</td>
											<td>",$row["precio"],"</td>
											<td>",$destacado,"</td>
											<td><a href='plantilla_producto.php?id_producto=",$row["id_producto"],"'>Detalle</a></td>
										</tr>";
								}
							}
							mysqli_close($link);
						}
		    		?>
				</tbody>
			</table>
		</div>
	</body>