<?php session_start(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Makeuplike</title>
		<link rel="shortcut icon" href="imagenes/icono.ico" >
		<link rel="stylesheet" href="estilos/estilos.css">
		<script language='javascript'>
			function anadirCarrito(){
				var cantidad = document.getElementById('cantidad').value;
				if(cantidad.length==0){
					alert("Tienes que ingresar una cantidad");
				}else{
					var id_producto = <?php echo $_GET["id_producto"]; ?>;
					location.href='guarda_carrito.php?id_producto='+id_producto+'&cantidad='+cantidad;
				}
			}
			function irCarrito(){
				location.href='carrito_de_compras.php';
			}
			function sinSession(){
				alert("Tienes que haber iniciado sesión para agregar productos al carrito");
			}
		</script>
	</head>
	<body>
		<header>
				<?php 
					if(!$_SESSION){
				?>
					<div class="sesion">
								<a href="iniciar_sesion.php">Iniciar sesión</a><a href="registro.php">Registrarse</a>
					</div>
				<?php
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
						$result=mysqli_query($link,"select * from categoria");
						while($row=mysqli_fetch_array($result)){
							echo "<li>",$row["nombre_categoria"],"
									<ul>";
							$result2 = mysqli_query($link,"select * from subcategoria where id_categoria = ".$row["id_categoria"]);
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
					if($_SESSION){
					$result = mysqli_query($link,"select * from compra,producto_compra,producto where pagado=0 and compra.id_compra=producto_compra.id_compra and producto_compra.id_producto=producto.id_producto and producto_compra.id_producto=".$_GET["id_producto"]." and id_usuario=".$_SESSION["id_usuario"]);
						echo mysqli_error($link);
						if(mysqli_num_rows($result) != 0){
							$carrito = "
										<button type='button' onclick='irCarrito()'>Este producto ya se encuentra en el carrito</button>";
						}else{
							$carrito = "<h3>Cantidad:<input id='cantidad' type='number' 			min='1' max='5' value='1'></h3>
										<button type='button'onclick='anadirCarrito()'>Añadir al carrito</button>";
						}
					}else{
						$carrito = "<h3>Cantidad:<input id='cantidad' type='number' 			min='1' max='5' value='1'></h3>
										<button type='button'onclick='sinSession()'>Añadir al carrito</button>";
					}
					$result=mysqli_query($link,"select * from producto,subcategoria,categoria where id_producto=".$_GET["id_producto"]." and producto.id_subcategoria=subcategoria.id_subcategoria and subcategoria.id_categoria=categoria.id_categoria");
					$row = mysqli_fetch_array($result);
					echo "<ul class='breadcrumb'>
								<li>",$row["nombre_categoria"],"</li>
								<li><a href='plantilla_subcategoria.php?id_subcategoria=",$row["id_subcategoria"],"'>",$row["nombre_subcategoria"],"</a></li>
								<li>",$row["marca"]," - ",$row["nombre"],"</li>
							</ul>
							<h1>",$row["marca"]," - ",$row["nombre"],"</h1>
							<div class='descripcion_producto'>
								<img src='",$row["imagen"],"'>
								  <div class='detalle'>
									<h1>$",$row["precio"],"</h1>
									",$carrito,"
									<p>",$row["descripcion"],"<br>
										<b>Tamaño:</b> ",$row["tamano"],"<br>
										<b>Fecha de caducidad:</b> ",$row["fecha_caducidad"],"
									</p>
								</div>
							</div>";
					mysqli_close($link);
				}
			?>
	</body>
</html>