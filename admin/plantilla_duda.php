<html>
	<head>
		<meta charset="UTF-8">
		<title>Makeuplike</title>
		<link rel="shortcut icon" href="../imagenes/icono.ico" >
		<link rel="stylesheet" href="../estilos/estilos.css">
		 <script language='javascript'>
			function verifica(){
				var r=window.confirm('¿Estas seguro que quieres borrar la duda?');
				var id_duda=<?php echo $_GET["id_duda"]; ?>;
					if(r)
						location.href='borra_duda.php?id_compra='+id_duda;
					}
			</script>
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
		<ul class="breadcrumb">
			<li><a href="dudas.php">Dudas</a></li>
			<li>Datos de duda</li>
		</ul>
		<div class="tabla">
			<h1>Datos de duda</h1>
			<table>
				<tbody>
					<?php
						include "../conexion.php";
						$link  = conectarse();
						if($link){
							$consulta = "select * from duda,usuario where id_duda=".$_GET["id_duda"]." and duda.id_usuario=usuario.id_usuario";
							$result=mysqli_query($link,$consulta);
							$row=mysqli_fetch_array($result);
							if(is_null($row["fecha_respuesta"])){
									$fecha_respuesta = "Ésta duda aún no ha sido respondida";
								}else{
									$fecha_respuesta = $row["fecha_respuesta"];
								}
							if(is_null($row["respuesta"])){
									$respuesta = "<a href='responder_duda.php?id_duda=".$row["id_duda"]."'>Responder</a>";
								}else{
									$respuesta = $row["respuesta"]." <a href='responder_duda.php?id_duda=".$row["id_duda"]."'>Cambiar respuesta</a>";
								}
								echo "<tr>
										<td>Usuario:</td>
										<td><a href='plantilla_usuario.php?id_usuario=",$row["id_usuario"],"'>",$row["nombre"]," ",$row["apellidos"],"</a></td>
									</tr>
									<tr>
										<td>Fecha de la duda:</td>
										<td>",$row["fecha_pregunta"],"</td>
									</tr>
									<tr>
										<td>Duda:</td>
										<td>",$row["contenido"],"</td>
									</tr>
									<tr>
										<td>Fecha de respuesta:</td>
										<td>",$fecha_respuesta,"</td>
									</tr>
									<tr>
										<td>Respuesta:</td>
										<td>",$respuesta,"</td>
									</tr>
									<tr>
										<td colspan='2'><button type='button' onclick='verifica()'>Eliminar duda</button></td>
									</tr>";
							
							mysqli_close($link);
						}
		    		?>
				</tbody>
			</table>
		</div>
	</body>