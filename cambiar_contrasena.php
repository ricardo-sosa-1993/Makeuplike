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
		<?php
			if($link){
						$result=mysqli_query($link,"select * from usuario where id_usuario=".$_SESSION["id_usuario"]);
						$row=mysqli_fetch_array($result);	
					}
		?>
		<form class="formulario" method="post" action="cambia_contrasena.php">
		<h1>Cambiar contraseña</h1>
			<table>
				<tr>
					<td>Contraseña actual*</td>
				</tr>
				<tr>
					<td><input type="password" size="30" maxlength="45" name="contrasena_antigua" required></td>
				</tr>
				<tr>
					<td>Contraseña nueva*</td>
				</tr>
				<tr>
					<td><input type="password" size="30" maxlength="45" name="contrasena_nueva1" required></td>
				</tr>
				<tr>
					<td>Confirma contraseña*</td>
				</tr>
				<tr>
					<td><input type="password" size="30" maxlength="45" name="contrasena_nueva2" required></td>
				</tr>
				<tr>
					<?php mysqli_close($link); ?>
					<td><input type="submit" value="Guardar"></td>
				</tr>
			</table>
		</form>
	</body>
</html>