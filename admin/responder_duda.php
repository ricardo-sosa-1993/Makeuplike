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
		<?php
			include "../conexion.php";
			$link = conectarse();
			$duda_query=mysqli_query($link,"select * from duda where id_duda=".$_GET["id_duda"]);
			$duda=mysqli_fetch_array($duda_query);
		?>
		<form class="formulario" method="post" action="responde_duda.php">
		<h1>Responder a duda</h1>
			<table>
				<tr><td>Duda: <?php echo $duda["contenido"];?></td></tr>
				<tr><td>Respuesta:</td></tr>
				<tr>
					<td>
						<textarea rows="4" cols="30" name="respuesta" required><?php echo $duda["respuesta"]; ?></textarea>
						<?php echo "<input type='hidden' name='id_duda' value='",$duda["id_duda"],"'>"; ?>
					</td>
				</tr>
				<tr>
				<?php mysqli_close($link); ?>
					<td><input type="submit" value="Guardar"></td>
				</tr>
			</table>
		</form>
	</body>
</html>