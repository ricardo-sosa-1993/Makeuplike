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
		<ul class="breadcrumb">
			<li><a href="productos.php">Productos</a></li>
			<li>Datos de producto</li>
		</ul>
		<div class="tabla">
			<h1>Datos de producto</h1>
			<table>
				<tbody>
					<?php
						include "../conexion.php";
						$link  = conectarse();
						if($link){
							$consulta = "select * from producto,subcategoria,categoria where id_producto=".$_GET["id_producto"]." and producto.id_subcategoria=subcategoria.id_subcategoria and subcategoria.id_categoria=categoria.id_categoria;";
							$result=mysqli_query($link,$consulta);
							$row=mysqli_fetch_array($result);
							if($row["destacado"]==0){
									$destacado="No";
								}else{
									$destacado="Si";
								}
								echo "
							<div class='descripcion_producto'>
								<img src='../",$row["imagen"],"'>
								  <div class='detalle'>
									<p>
										<b>Nombre:</b> ",$row["nombre"],"<br>
										<b>Marca:</b> ",$row["marca"],"<br>
										<b>Precio:</b> $",$row["precio"],"<br>
										<b>Destacado:</b> ",$destacado,"<br>
										<b>Categoria:</b> ",$row["nombre_categoria"],"<br>
										<b>Subcategoria:</b> ",$row["nombre_subcategoria"],"<br>
										<b>Tamaño:</b> ",$row["tamano"],"<br>
										<b>Fecha de caducidad:</b> ",$row["fecha_caducidad"],"<br>
										<b>Descripción:</b> ",$row["descripcion"],"<br> 
									</p>
									<button type='button'onclick='editar()'>Editar</button>
									<button type='button' onclick='verifica()'>Eliminar</button>
								</div>
							</div>
							<script language='javascript'>
								function verifica(){
									var r=window.confirm('¿Estas seguro que quieres borrar el producto?');
									if(r)
										location.href='borra_producto.php?id_producto=",$row["id_producto"],"';
								}

								function editar(){
									location.href='editar_producto.php?id_producto=",$row["id_producto"],"';
								}
							</script>";
							mysqli_close($link);
						}
		    		?>
				</tbody>
			</table>
		</div>
	</body>