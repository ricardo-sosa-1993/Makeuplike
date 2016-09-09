<html>
	<head>
		<meta charset="UTF-8">
		<title>Delineadores</title>
		<link rel="shortcut icon" href="imagenes/icono.ico" >
		<link rel="stylesheet" href="estilos/estilos.css">
	</head>
	<body>
		<header>
				<?php
					session_start(); 
					if(!$_SESSION){
				?>
					<div class="sesion">
								<a href="iniciar_sesion.php">Iniciar sesión</a><a href="registro.php">Registrarse</a>
					</div>
				<?php
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
			<?php
				if($link){
					$subcategoria = $_GET["id_subcategoria"];
					$result=mysqli_query($link,"select * from subcategoria,categoria where id_subcategoria=".$subcategoria." and subcategoria.id_categoria=categoria.id_categoria");
					$row=mysqli_fetch_array($result);
					echo "<ul class='breadcrumb'>
								<li>",$row["nombre_categoria"],"</li>
								<li>",$row["nombre_subcategoria"],"</li>
							  </ul>
							<h1>",$row["nombre_subcategoria"],"</h1>
							<div class='contenedor'>";
					$result=mysqli_query($link,"select id_producto,nombre,precio,marca,nombre_subcategoria,imagen from producto,subcategoria where producto.id_subcategoria=".$subcategoria." and producto.id_subcategoria=subcategoria.id_subcategoria");
					while($row=mysqli_fetch_array($result)){
						echo "<div class='producto'>
								<a href='plantilla_producto.php?id_producto=",$row["id_producto"],"&nombre_subcategoria=",$row["nombre_subcategoria"],"'><img src='",$row["imagen"],"'/></a>
									<h3>",$row["marca"]," - ",$row["nombre"],"</h3>
									<h4>$",$row["precio"],"</h4>
							  </div>";
					}
					mysqli_close($link);
				}
		    ?>
		</div>
	</body>
</html>