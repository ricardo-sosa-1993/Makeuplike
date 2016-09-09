<html>
	<head>
		<meta charset="UTF-8">
		<title>Registro</title>
		<link rel="shortcut icon" href="imagenes/icono.ico" >
		<link rel="stylesheet" href="estilos/estilos.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  		<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  		<script type="text/javascript">
  			$(function() {
			    for (i = new Date().getFullYear(); i > 1900; i--){
			        $('#years').append($('<option />').val(i).html(i));
			    }
			    for(i=1;i<=31;i++){
			    	$('#days').append($('<option />').val(i).html(i));
			    }
			    $('form').submit(function(e){
			        if($('#contrasena').val()!=$('#confirma_contrasena').val()){
			        	e.preventDefault();
			        	alert("Las contraseñas introducidas no coinciden");
			        }
			        });
			});
  		</script>
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
		<form class="formulario" method="post" action="registro.php">
		<h1>Registro</h1>
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
						</select>
					</td>
				</tr>
				<tr>
					<td>Teléfono</td>
				</tr>
				<tr>
					<td><input type="text" name="telefono" maxlength="10" placeholder="Lada + número telefónico" size="30"></td>
				</tr>
				<tr>
					<td><input type="submit" value="Registrarse"></td>
				</tr>
			</table>
		</form>
		<?php
			include "guarda_usuario.php";
			if($_POST){
				guardar();
			}
		?>
	</body>
</html>