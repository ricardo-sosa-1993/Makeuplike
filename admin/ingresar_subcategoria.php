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
		<form class="formulario" method="POST" action="ingresar_subcategoria.php">
			<table>
				<tr><td>Nombre*</td></tr>
				<tr><td><input type="text" size="30" maxlength="45" name="nombre_subcategoria" required></td></tr>
				<tr>
					<td>
						<select name="id_categoria">
							<?php
								include "../conexion.php";
								$link = conectarse();
								if($link){
									$result=mysqli_query($link,"select * from categoria");
									while($row=mysqli_fetch_array($result)){
										echo "<option value='",$row["id_categoria"],"'>
													",$row["nombre_categoria"],"
											  </option>";
									}
									mysqli_close($link);
								}
							?>
						</select>
					</td>
				</tr>
				<tr><td><input type="submit" value="Guardar"></td></tr>
			</table>
		</form>
		<?php
			include "guarda_subcategoria.php";
			if($_POST){
				guardar();
			}
		?>
	</body>
</html>