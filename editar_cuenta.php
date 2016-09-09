<html>
	<head>
		<meta charset="UTF-8">
		<title>Carrito de compras</title>
		<link rel="shortcut icon" href="imagenes/icono.ico" >
		<link rel="stylesheet" href="estilos/estilos.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  		<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
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
						$result=mysqli_query($link,"select correo_electronico,nombre,apellidos, day(fecha_nacimiento) as dia, month(fecha_nacimiento) as mes, year(fecha_nacimiento) as ano, telefono from usuario where id_usuario=".$_SESSION["id_usuario"]);
						$row=mysqli_fetch_array($result);	
					}
		?>
		<form class="formulario" method="post" action="edita_cuenta.php">
		<h1>Datos de cuenta</h1>
			<table>
				<tr>
					<td>Correo electrónico*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" value="<?php echo $row["correo_electronico"]; ?>" name="correo_electronico" required></td>
				</tr>
				<tr>
					<td>Nombre*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" value="<?php echo $row["nombre"]; ?>" name="nombre" required></td>
				</tr>
				<tr>
					<td>Apellidos*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" value="<?php echo $row["apellidos"]; ?>" name="apellidos" required></td>
				</tr>
				<tr>
					<td>Fecha de nacimiento*</td>
				</tr>
				<tr>
					<td>
						<select id="days" name="dia" required>
							<option value="" disabled selected>Día</option>
							<?php 
								for($i=1;$i<=31;$i++){
									echo "<option value='",$i,"'>",$i,"</option>";
								}
							?>
						</select>
						<select id="months" name="mes" required>
							<option value="" disabled selected>Mes</option>
							<option value="1">Enero</option>
							<option value="2">Febrero</option>
							<option value="3">Marzo</option>
							<option value="4">Abril</option>
							<option value="5">Mayo</option>
							<option value="6">Junio</option>
							<option value="7">Julio</option>
							<option value="8">Agosto</option>
							<option value="9">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select>
						<select id="years" name="ano" required>
							<option value="" disabled selected>Año</option>
							<?php 
								for($i=date("Y");$i>1900;$i--){
									echo "<option value='",$i,"'>",$i,"</option>";
								}
							?>
						</select>
					</td>
					<script>
						 $('#days').val('<?php echo $row["dia"]; ?>');
				$('#months').val('<?php echo $row["mes"]; ?>');
				$('#years').val('<?php echo $row["ano"]; ?>');
					</script>
				</tr>
				<tr>
					<td>Teléfono</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" value="<?php echo $row["telefono"]; ?>" name="telefono"></td>
				</tr>				
					<?php mysqli_close($link); ?>
					<td><input type="submit" value="Guardar"></td>
				</tr>
			</table>
		</form>
	</body>
</html>