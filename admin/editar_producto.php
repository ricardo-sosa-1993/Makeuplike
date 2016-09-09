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
			$editar_query=mysqli_query($link,"select * from producto where id_producto=".$_GET["id_producto"]);
			$editar=mysqli_fetch_array($editar_query);
		?>
		<form class="formulario" method="POST" action="edita_producto.php" enctype="multipart/form-data">
			<table>
				<tr><td>Nombre*</td></tr>
				<tr><td><input type="text" size="30" maxlength="45" name="nombre" value="<?php echo $editar["nombre"]; ?>" required></td></tr>
				<tr><td>Marca*</td></tr>
				<tr><td><input type="text" size="30" maxlength="45" name="marca" value="<?php echo $editar["marca"]; ?>" required></td></tr>
				<tr><td>Subcategoria</td></tr>
				<tr>
					<td>
						<select name="subcategoria">
							<?php
								$link = conectarse();
								if($link){
									$result=mysqli_query($link,"select * from categoria");
									while($row=mysqli_fetch_array($result)){
										echo "<optgroup label='",$row["nombre_categoria"],"'>";
										$result2 = mysqli_query($link,"select * from subcategoria where activo=1 and id_categoria = ".$row["id_categoria"]);
										while($row2=mysqli_fetch_array($result2)){
											if($editar["id_subcategoria"]==$row2["id_subcategoria"])
											echo "<option selected='selected 'value='",$row2["id_subcategoria"],"'>",$row2["nombre_subcategoria"],"</option>";
											else
											echo "<option value='",$row2["id_subcategoria"],"'>",$row2["nombre_subcategoria"],"</option>";
										}
										echo "</optgroup>";
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr><td>Precio*</td></tr>
				<tr><td><input type="number" size="30" maxlength="45" name="precio" min="0" step="any" value="<?php echo $editar["precio"]; ?>"required></td></tr>
				<tr><td>Tamaño</td></tr>
				<tr><td><input type="text" size="30" maxlength="45" name="tamano" value="<?php echo $editar["tamano"]; ?>"></td></tr>
				<tr><td>Fecha de caducidad</td></tr>
				<td><input type="date" name="fecha_caducidad" value="<?php echo $editar["fecha_caducidad"]; ?>"></td>
				<tr><td>Destacado</td></tr>
				<tr>
					<td>
						<?php
							if($editar["destacado"]==0)
								echo "<select name='destacado'>
										<option selected='selected' value='0'>No</option>
										<option value='1'>Si</option>
									 </select>";
							else
								echo "<select name='destacado'>
										<option value='0'>No</option>
										<option selected='selected' value='1'>Si</option>
									 </select>";
						?>
					</td>
				</tr>
				<tr><td>Imagen</td></tr>
				<tr><td><input type="file" name="archivo" id="archivo" accept="image/*"></td></tr>
				<tr><td>Descripción*</td></tr>
				<tr>
					<td>
						<textarea rows="4" cols="30" name="descripcion" required><?php echo $editar["descripcion"]; ?></textarea>
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Guardar"></td>
				</tr>
				<?php echo "<input type='hidden' name='id_producto' value='",$editar["id_producto"],"'>"; ?>
				<?php mysqli_close($link); ?>
			</table>
		</form>
	</body>
</html>