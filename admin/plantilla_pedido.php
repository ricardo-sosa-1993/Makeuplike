<html>
	<head>
		<meta charset="UTF-8">
		<title>Makeuplike</title>
		<link rel="shortcut icon" href="../imagenes/icono.ico" >
		<link rel="stylesheet" href="../estilos/estilos.css">
		  <link href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
  <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
 
 <script>
	       $(document).ready(function() {
            $("#dialog").dialog({
                autoOpen: false,
                modal: true,
                width: "25%",
                resizable: false
            });

            $("#opener").click(function(){
            	$("#datepicker").datepicker();
            	$("#dialog").dialog("open");
            });

            $("#submit").click(function() {
            	var dia = $("#datepicker").datepicker('getDate').getDate();                 
            	var mes = $("#datepicker").datepicker('getDate').getMonth() + 1;             
            	var ano = $("#datepicker").datepicker('getDate').getFullYear();
            	var id_compra = <?php echo $_GET["id_compra"]; ?>;
				url = "envia_pedido.php?id_compra="+id_compra+"&dia="+dia+"&mes="+mes+"&ano="+ano;
     			 $( location ).attr("href", url);
			});
        });


  </script>
  <script language='javascript'>
			function verifica(){
				var r=window.confirm('¿Estas seguro que quieres borrar el pedido?');
				var id_compra=<?php echo $_GET["id_compra"]; ?>;
					if(r)
						location.href='borra_pedido.php?id_compra='+id_compra;
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
			<li><a href="pedidos.php">Pedidos</a></li>
			<li>Datos de pedido</li>
		</ul>
		<div id="dialog" title="Seleccionar fecha de envio">
	        Fecha:
	        <input type="text" id="datepicker">
	        <input id="submit" type="submit" value="Guardar">
    	</div>
  
		<div class="tabla">
			<h1>Datos de pedido</h1>
			<table>
				<tbody>
					<?php
						include "../conexion.php";
						$link  = conectarse();
						if($link){
							$id_compra=$_GET["id_compra"];
							$consulta = "select * from usuario,compra where id_compra=".$id_compra." and usuario.id_usuario = compra.id_usuario and pagado = 1";
							$result=mysqli_query($link,$consulta);
							$row=mysqli_fetch_array($result);
							if(is_null($row["fecha_enviado"])){
									$estatus="Pendiente <button id='opener'>Ingresar fecha de envío</button>";
								}else{
									$estatus="Enviado el ".$row["fecha_enviado"]." <button id='opener'>Cambiar fecha de envío</button>";
								}
								echo "<tr>
										<td>ID del pedido:</td>
										<td>",$row["id_compra"],"</td>
									  </td>
									<tr>
										<td>Destinatario:</td>
										<td><a href='plantilla_usuario.php?id_usuario=",$row["id_usuario"],"'>",$row["nombre"]," ",$row["apellidos"],"</a></td>
									</tr>
									<tr>
										<td>Teléfono:</td>
										<td>",$row["telefono"],"</td>
									</tr>
									<tr>
										<td>Correo electrónico:</td>
										<td>",$row["correo_electronico"],"</td>
									</tr>
									<tr>
										<td>Fecha de compra:</td>
										<td>",$row["fecha"],"</td>
									</tr>
									<tr>
										<td>Calle y número:</td>
										<td>",$row["calle_num"],"</td>
									</tr>
									<tr>
										<td>Colonia:</td>
										<td>",$row["colonia"],"</td>
									</tr>
									<tr>
										<td>Ciudad:</td>
										<td>",$row["ciudad"],"</td>
									</tr>
									<tr>
										<td>Estado:</td>
										<td>",$row["estado"],"</td>
									</tr>
									<tr>
										<td>Código postal:</td>
										<td>",$row["codigo_postal"],"</td>
									</tr>
									<tr>
										<td>Estatus:</td>
										<td>",$estatus,"</td>
									</tr>
									</tbody>
									</table>
									</div>
									<div class='tabla'>
									<h1>Productos del pedido</h1>
									<table>
									<thead>
										<tr>
											<th>ID del producto</th>
											<th>Nombre del producto</th>
											<th>Precio unitario</th>
											<th>Cantidad</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										";
									$consulta = "select * from producto,producto_compra where id_compra=".$id_compra." and producto.id_producto=producto_compra.id_producto";
									$result=mysqli_query($link,$consulta);
									$total = 0;
							while($row=mysqli_fetch_array($result)){
								$total = $total + $row["subtotal"];
								echo "
										<tr>
											<td>",$row["id_producto"],"</td>
											<td><a href='plantilla_producto.php?id_producto=",$row["id_producto"],"'>",$row["marca"]," - ",$row["nombre"],"</a></td>
											<td>$",$row["precio_unitario"],"</td>
											<td>",$row["cantidad"],"</td>
											<td>$",$row["subtotal"],"</td>
										</tr>
									";
							}
							echo "
									</tbody>
									<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th>Total</th>
												<th>$",$total,"</th>
											</tr>
										</tfoot>
									</table>
									</div>
									";
							
							mysqli_close($link);
						}
		    		?>
	</body>