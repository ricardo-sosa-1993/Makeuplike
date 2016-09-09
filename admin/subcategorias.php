<html>
	<head>
		<meta charset="UTF-8">
		<title>Makeuplike</title>
		<link rel="shortcut icon" href="../imagenes/icono.ico" >
		<link rel="stylesheet" href="../estilos/estilos.css">
		<script language='javascript'>
								function verifica(id_subcategoria){
									var r=window.confirm('¿Estas seguro que quieres borrar la subcategoría? Todos los productos en esta subcategoria se borrarán');
									if(r)
										location.href='borra_subcategoria.php?id_subcategoria='+id_subcategoria;
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
		<div class="tabla">
			<h1>Subcategorías</h1>
			<table>
				<tbody>
		    		<?php
								include "../conexion.php";
								$link = conectarse();
								if($link){
									$result=mysqli_query($link,"select * from categoria where activo=1");
									while($row=mysqli_fetch_array($result)){
										echo "<tr><th colspan='2'>",$row["nombre_categoria"],"</th></tr>";
										$result2 = mysqli_query($link,"select * from subcategoria where activo=1 and id_categoria = ".$row["id_categoria"]);
										while($row2=mysqli_fetch_array($result2)){
											echo "<tr>
										<td>",$row2["nombre_subcategoria"],"</td>
										<td><button type='button' onclick='verifica(",$row2["id_subcategoria"],")'>Eliminar</button></td>
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
</html>