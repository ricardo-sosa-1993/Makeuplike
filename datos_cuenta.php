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
			<h1>Datos de la cuenta</h1>
			<table>
				<tbody>
					<?php
						$link  = conectarse();
						if($link){
							$consulta = "select * from usuario where id_usuario=".$_SESSION["id_usuario"];
							$result=mysqli_query($link,$consulta);
							$row=mysqli_fetch_array($result);
							
								echo "
									<tr>
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
										<td>Correo electrónico:</td>
										<td>",$row["correo_electronico"],"</td>
									</tr>
									<tr>
										<td>Número telefónico:</td>
										<td>",$row["telefono"],"</td>
									</tr>
									<tr>
										<td colspan='2'><a href='editar_cuenta.php'>Cambiar datos</a></td>
									</tr>
									</tbody>
									</table>
									</div>
									";
							
							mysqli_close($link);
						}
		    		?>
	</body>