<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie-edge">
	<title>NXT TECH - Si lo quieres, cómpralo</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../MyCSS/efectosComunes.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|PT+Serif" rel="stylesheet">
	<style>
		
	</style>
</head>
<body>
	<?php
		$idUsuario = $_SESSION['id_Usuario'];
		$idProducto = $_GET['idProducto'];
		$nombImg = "";
		$descripcion = "";
		$datosUsuario = "";
		$direccion = "";
		$precio = "";
		$categoria = "";
		$fecha = "";
		$metodoPago = "";
		$busqueda = "";

		if(!empty($_POST['buscador'])){
			$busqueda = $_POST['busqueda'];
			header("Location: buscador.php?busqueda=$busqueda");
		}

		$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("No se puede conectar al servidor");
		mysqli_set_charset($conexion, 'utf8');

		$consultaProducto = mysqli_query($conexion, "SELECT DESCRIPCION, img, PRECIO, CATEGORIA FROM producto WHERE ID_PRODUCTO ='" . $idProducto . "'") or die("Error en la consulta");
		$nFilasProducto = mysqli_num_rows($consultaProducto);

		$consultaUsuario = mysqli_query($conexion, "SELECT cliente.* FROM cliente WHERE ID_CLIENTE='" . $idUsuario . "'") or die("Error en la consulta");
		$nFilasUsuario = mysqli_num_rows($consultaUsuario);

		if($nFilasProducto > 0 && $nFilasUsuario > 0){
			$filaProducto = mysqli_fetch_array($consultaProducto);
			$filaUsuario = mysqli_fetch_array($consultaUsuario);
			$nombImg = $filaProducto['img'];
			$descripcion = $filaProducto['DESCRIPCION'];
			$datosUsuario = $filaUsuario['NOMBRE'] . " " . $filaUsuario['APELLIDOS'];
			$direccion = $filaUsuario['DIRECCION'];
			$precio = $filaProducto['PRECIO'];
			$categoria = $filaProducto['CATEGORIA'];
			$fecha = date('Y-m-d');
		}

			if(isset($_POST['comprar'])){
				$metodoPago = $_POST['metodoPago'];

				if($metodoPago == "tarjeta"){
					
					$consultaTarjeta = mysqli_query($conexion, "SELECT * FROM tarjeta WHERE ID_CLIENTE ='" . $idUsuario . "'") or die("Error en la consulta de la tarjeta");
					$nFilasTarjeta = mysqli_num_rows($consultaTarjeta);

					if($nFilasTarjeta > 0){
						$insert = mysqli_query($conexion, "INSERT into transacciones(ID_CLIENTE, ID_PRODUCTO, DESCRIPCION, PRECIO, FECHA_COMPRA, DIRECCION, METODO_PAGO, CATEGORIA) VALUES('$idUsuario', '$idProducto', '$descripcion', '$precio', '$fecha', '$direccion', '$metodoPago', '$categoria')") or die("Error en la inserción");

						if($insert){
							$deleteDeseos = mysqli_query($conexion, "DELETE FROM deseos WHERE ID_PRODUCTO='" . $idProducto . "'") or die("Error en el borrado de deseos");

							$deleteProducto = mysqli_query($conexion, "DELETE FROM producto WHERE ID_PRODUCTO='" . $idProducto . "'") or die("Error en el borrado de producto");

							if($deleteDeseos && $deleteProducto){
								mysqli_close($conexion);
								header("Location: seguirComprando.php?idProductoComprado=$idProducto");
							}
						}
					}else{
						mysqli_close($conexion);
						echo "<script>alert('Para comprar con tarjeta primero debe dar de alta una tarjeta');</script>";
					}
			}else{
				$insert = mysqli_query($conexion, "INSERT into transacciones(ID_CLIENTE, ID_PRODUCTO, DESCRIPCION, PRECIO, FECHA_COMPRA, DIRECCION, METODO_PAGO, CATEGORIA) VALUES('$idUsuario', '$idProducto', '$descripcion', '$precio', '$fecha', '$direccion', '$metodoPago', '$categoria')") or die("Error en la inserción");

				if($insert){
					$deleteDeseos = mysqli_query($conexion, "DELETE FROM deseos WHERE ID_PRODUCTO='" . $idProducto . "'") or die("Error en el borrado de deseos");

					$deleteProducto = mysqli_query($conexion, "DELETE FROM producto WHERE ID_PRODUCTO='" . $idProducto . "'") or die("Error en el borrado de producto");

					if($deleteDeseos && $deleteProducto){
						mysqli_close($conexion);
						header("Location: seguirComprando.php?idProductoComprado=$idProducto");
					}
				}else{
					mysqli_close($conexion);
				}
			}
		}
	?>
	<header>
		<div class="container m-4">
			<div class="row">
				<div class="col">
					<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
						<a href="index.php" class="navbar-brand"><img src="../img/logo.png" style="width: 70px;"></a>

						<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#barraNav">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse justify-content-between" id="barraNav">
							<ul class="navbar-nav">
								<li class="nav-item"><a href="index.php" class="nav-link"><span class="text-warning">Home</span></a></li>
								<li class="nav-item"><a href="lista.php" class="nav-link"><span class="text-warning"><span>La lista de la semana</span></a></li>
								<li class="nav-item"><a href="inicioSesion.php" class="nav-link"><span class="text-warning">Regístrate/Inicia Sesión</span></a></li>
								<li class="nav-item dropdown">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><span class="text-warning">¿Quieres algo?</span></a>

									<div class="dropdown-menu bg-info">
										<div class="dropdown-header text-white font-weight-bold">Nuestro Catálogo</div>
										<div class="dropdown-divider"></div>
										<a href="videojuegosConsolas.php" class="dropdown-item text-dark font-weight-bold">Videojuegos y Consolas</a>
										<a href="movilesTablets.php" class="dropdown-item text-dark font-weight-bold">Móviles y Tablets</a>
										<a href="fotografiaVideo.php" class="dropdown-item text-dark font-weight-bold">Fotografía y Vídeo</a>
									</div>

								</li>
							</ul>

							<form action="" method="post" class="form-inline">
								<input type="text" name="busqueda" placeholder="¿Qué buscas?" class="form-control mr-sm-2">
								<input type="submit" name="buscador" class="btn btn-success" value="Buscar">
							</form>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>

	<section>
		<div class="container p-5">
			<div class="row bg-white">

				<div class="col-3 p-3">
					<figure>
						<?php 
							if(!empty($nombImg)){ echo "<img src='../Productos Subidos/" . $nombImg . "' class='img-fluid'>";}
						?>
					</figure>
				</div>

				<div class="col-9 p-3">
					<form action="" method="post">
						<label for="datosProducto" class="font-weight-bold">Artículo</label>
						<input type="text" name="datosProducto" class="form-control" required disabled
							<?php 
								if(!empty($descripcion)){
									echo "value='" . $descripcion . "'";
								}
							?>
						>

						<label for="datosComprador" class="font-weight-bold">Datos Comprador</label>
						<input type="text" name="datosComprador" class="form-control" required disabled
							<?php 
								if(!empty($datosUsuario)){
									echo "value='" . $datosUsuario . "'";
								}
							?>
						>

						<label for="direccion" class="font-weight-bold">Direccion de Envío</label>
						<input type="text" name="direccion" class="form-control" required disabled
							<?php 
								if(!empty($direccion)){
									echo "value='" . $direccion . "'";
								}
							?>
						>

						<label for="precio" class="font-weight-bold">Precio</label>
						<input type="text" name="precio" class="form-control" required disabled
							<?php 
								if(!empty($precio)){
									echo "value='" . $precio . "€'";
								}
							?>
						>

						<label for="fecha" class="font-weight-bold">Fecha Compra</label>
						<input type="text" name="fecha" class="form-control" required disabled
							<?php 
								if(!empty($fecha)){
									echo "value='" . $fecha . "'";
								}
							?>
						>

						<label for="metodoPago" class="font-weight-bold">Seleccione método de pago</label>
						<br/>
						<select name="metodoPago" required>
							<option value="">Seleccione una opción</option>
							<option value="paypal">PayPal</option>
							<option value="tarjeta">Tarjeta</option>
						</select>
						<br/>
						<br/>

						<input type="submit" name="comprar" value="Comprar Artículo" class="btn btn-success w-100">
					</form>
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="container-fluid bg-info">
			<div class="row">
				<div class="col-3">
					<figure><img src="../img/logo.png" style="width: 100px; margin-top: 10px;"></figure>
					<br>
					<button type="button" class="btn btn-warning font-weight-bold" data-toggle="modal" data-target="#miModal">
						Suscríbete
					</button>

					<div id="miModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-warning">
									<h4 class="modal-title">Suscribete a nuestro newsletter</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body">
									<h4>Contacto</h4>
									<form action="" method="post">
										<label for="usuario">Nombre de usuario</label><input type="text" id="usuario" class="form-control" required>
										<label for="email">Email</label><input type="email" id="email" class="form-control" required>
										<br>
										<input type="submit" value="Enviar" class="btn btn-primary">
									</form>
								</div>

								<div class="modal-footer bg-light">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-3 p-3">
					<h5 class="text-white">NxT Tech</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="#"><span class="text-white">>¿Quienes somos?</span></a></li>
						<li><a href="#"><span class="text-white">>Empleo</span></a></li>
						<li><a href="#"><span class="text-white">>Prensa</span></a></li>
						<li><a href="#"><span class="text-white">>Contacto</span></a></li>
					</ul>
				</div>

				<div class="col-3 p-3">
					<h5 class="text-white">Soporte</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="#"><span class="text-white">>Preguntas Frecuentes</span></a></li>
						<li><a href="#"><span class="text-white">>Reglas de Convivencias</span></a></li>
						<li><a href="#"><span class="text-white">>Consejos de Seguridad</span></a></li>
					</ul>
				</div>

				<div class="col-3 p-3">
					<h5 class="text-white">Legal</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="#"><span class="text-white">>Condiciones de Uso</span></a></li>
						<li><a href="#"><span class="text-white">>Privacidad</span></a></li>
						<li><a href="#"><span class="text-white">>Cookies</span></a></li>
					</ul>
				</div>
			</div>
			<hr/ class="bg-white">
			<div class="row">
				<div class="col d-flex justify-content-center">
					<figure><a href="#" data-toggle="tooltip" title="Dale a like a nuestro Facebok"><img src="../img/icons8-facebook-52.png" class="w-50 m-2"></a></figure>
					<figure><a href="#" data-toggle="tooltip" title="Siguenos en Twitter"><img src="../img/icons8-twitter-48.png" class="w-50 m-2"></a></figure>
					<figure><a href="#" data-toggle="tooltip" title="Siguenos en Instagram"><img src="../img/icons8-instagram-48.png" class="w-50 m-2"></a></figure>
					<figure><a href="#" data-toggle="tooltip" title="Nuestro Google+"><img src="../img/icons8-google-plus-60.png" class="w-50 m-2"></a></figure>
					<figure><a href="#" data-toggle="tooltip" title="Contáctanos!"><img src="../img/icons8-secured-letter-50.png" class="w-50 m-2"></a></figure>
				</div>
			</div>

			<div class="row">
				<div class="col text-center" style="height: 50px;">
					<span class="font-weight-bold text-white">© Todos los derechos reservados. NxT Tech</span>
				</div>
			</div>
		</div>
	</footer>
	<script src="../js/jquery-3.3.1.slim.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>