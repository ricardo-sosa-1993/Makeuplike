<html>
	<head>
		<meta charset="UTF-8">
		<title>Makeuplike</title>
		<link rel="shortcut icon" href="imagenes/icono.ico" >
		<link rel="stylesheet" href="estilos/estilos.css">
		<script language='javascript'>
			function borra(id_duda){
				var r=window.confirm('¿Estas seguro que quieres borrar la duda?');
					if(r)
						location.href='borra_duda.php?id_duda='+id_duda;
					}
			</script>
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
			<h1>Dudas</h1>
			<table >
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Duda</th>
						<th>Fecha de respuesta</th>
						<th>Respuesta</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						if($link){
							$result=mysqli_query($link,"select * from duda where id_usuario=".$_SESSION["id_usuario"]." order by fecha_pregunta");
							while($row=mysqli_fetch_array($result)){
								if(is_null($row["fecha_respuesta"])){
									$fecha_respuesta="-";
									$respuesta="Esta duda aún no ha sido respondida";
								}else{
									$fecha_respuesta=$row["fecha_respuesta"];
									$respuesta=$row["respuesta"];
								}
								echo "<tr>
										<td>",$row["fecha_pregunta"],"</td>
										<td>",$row["contenido"],"</td>
										<td>",$fecha_respuesta,"</td>
										<td>",$respuesta,"</td>
										<td><button onclick='borra(",$row["id_duda"],")'>Borrar</button></td>
									</tr>";
							}
							mysqli_close($link);
						}
		    		?>
				</tbody>
			</table>
		</div>
	</body>
</html>