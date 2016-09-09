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
		<FORM class="formulario" action="agregar_administrador.php" method="post">
				<h1>Nuevo administrador</h1>
	    		<table>
		    		<tr>
					<td>Nombre*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" name="nombre" required></td>
				</tr>
				<tr>
					<td>Apellidos*</td>
				</tr>
				<tr>
					<td><input type="text" size="30" maxlength="45" name="apellidos" required></td>
				</tr>
				<tr>
					<td>E-mail*</td>
				</tr>
				<tr>
					<td><input type="email" size="30" maxlength="45" placeholder="nombre@dominio.com" name="correo_electronico" required></td>
				</tr>
				<tr>
					<td>Contraseña*</td>
				</tr>
				<tr>
					<td><input id="contrasena" type="password" size="30" maxlength="15" name="contrasena" required></td>
				</tr>
				<tr>
					<td>Confirma tu contraseña*</td>
				</tr>
				<tr>
					<td><input id="confirma_contrasena" type="password" size="30" maxlength="15" name="confirma_contrasena" required></td>
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
						<select name="mes" required>
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
				</tr>
				<tr>
					<td><input type="submit" value="Guardar"></td>
				</tr>
		    	</table>
					<?php
					include "inserta_usuario.php";
						if($_POST){
							guardar();
						}
					?>
 			</FORM>
 			<div class="tabla"> 
 				<h1>Administradores</h1>
 				<table>
 					<tbody>
 						<?php
 							include "../conexion.php";
 							$link= conectarse();
	 						$result=mysqli_query($link,"select * from usuario where administrador=1");
								echo mysqli_error($link);
								while($row=mysqli_fetch_array($result)){
									if($_SESSION["correo_electronico"]==$row["correo_electronico"]){
										echo "<tr>
											<td colspan='2'>",$row["correo_electronico"],"</td>
										
											<script>
											function verifica",$row["correo_electronico"],"(){
												var r = confirm('¿Seguro que deseas eliminar el usuario ",$row["correo_electronico"],"?');
												if(r){
													location.href='elimina_administrador.php?id_usuario=",$row["id_usuario"],"';
												}
											}
											</script>
										</tr>";
									}else{
										$eliminar = "<button onclick='verifica".$row["id_usuario"]."()'>Eliminar</button>";
										echo "<tr>
											<td>",$row["correo_electronico"],"</td>
											<td>",$eliminar,"</td>
											<script>
											function verifica",$row["id_usuario"],"(){
												var r = confirm('¿Seguro que deseas eliminar el usuario ",$row["correo_electronico"],"?');
												if(r){
													location.href='elimina_administrador.php?id_usuario=",$row["id_usuario"],"';
												}
											}
											</script>
										</tr>";
									}
									
								}
								mysqli_close($link);
					
						?>
 					</tbody>
 				</table>
 			</div>
	</body>
</html>