<html>
	<head>
		<meta charset="UTF-8">
		<title>Iniciar sesión</title>
		<link rel="shortcut icon" href="imagenes/icono.ico" >
		<link rel="stylesheet" href="estilos/estilos.css">
	</head>
	<body>
		<header >
				<div class="sesion">
							<a href="iniciar_sesion.php">Iniciar sesión</a><a href="registro.php">Registrarse</a>
				</div>
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
						mysqli_close($link);
					}
				?>
				<div class="busqueda">
					<form id="formulario" action="buscar.php" method="get">
						<input type="search" name="busqueda" placeholder="Término de búsqueda"/>
						<input type="image" src="imagenes/lupa.png"  alt="Submit" />
					</form>
				</div>
		</nav>
			<form class="formulario" method="post" action="control.php">
				<h1>Iniciar sesión</h1>
				<table>
					<tr>
						<td>E-mail</td>
					</tr>
					<tr>
						<td><input type="email" name="correo"required></td>
					</tr>
					<tr>
						<td>Contraseña</td>
					</tr>
					<tr>
						<td><input type="password" name="contrasena"required></td>
					</tr>
					<tr>
						<td><input type="submit" value="Ingresar"/></td>
					</tr>
				</table>
			</form>
	</body>
</html>