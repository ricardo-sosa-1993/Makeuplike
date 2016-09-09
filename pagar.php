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
						mysqli_close($link);
					}
				?>
				<div class="busqueda">
					<form action="buscar.php" method="get">
						<input type="search" name="busqueda" placeholder="Término de búsqueda"/>
						<input type="image" src="imagenes/lupa.png"  alt="Submit" />
					</form>
				</div>
		</nav>
		<form class="formulario" method="post" action="paga_pedido.php">
		<h1>Datos de compra</h1>
			<table>
				<tr>
					<td>Calle y número*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" name="calle_num" required></td>
				</tr>
				<tr>
					<td>Colonia*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" name="colonia" required></td>
				</tr>
				<tr>
					<td>Ciudad*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" name="ciudad" required></td>
				</tr>
				<tr>
					<td>Estado*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" name="estado" required></td>
				</tr>
				<tr>
					<td>Código postal*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="20" name="codigo_postal" required></td>
				</tr>
				<tr>
					<td>Número de tarjeta de credito*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" required></td>
				</tr>
				<tr>
					<td>Código de seguridad*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45"  required></td>
				</tr>
				<tr>
					<input type="hidden" name="id_compra" value="<?php echo $_GET["id_compra"]; ?>">
					<td><input type="submit" value="Enviar"></td>
				</tr>
			</table>
		</form>
	</body>
</html>