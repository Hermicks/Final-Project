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
		$id_Usuario = "";
		$busqueda = "";
		$nombImg = "";
		$descripcionProducto = "";
		$categoriaProducto = "";
		$precioProducto = "";
		$usuarioSubida = "";
		$idUsuarioSubida = "";

		$idProducto = $_GET['idProducto'];
		
		$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("Error al conectarse con el servidor");
		mysqli_set_charset($conexion, 'utf8');

		$consulta = mysqli_query($conexion, "SELECT producto.*, cliente.NOMBRE FROM producto inner join cliente on producto.ID_CLIENTE=cliente.ID_CLIENTE WHERE ID_PRODUCTO ='" . $idProducto . "'") or die("No se puede ejecutar la consulta");
		$nFilas = mysqli_num_rows($consulta);

		if($nFilas > 0){
			$fila = mysqli_fetch_array($consulta);
			$nombImg = $fila['img'];
			$descripcionProducto = $fila['DESCRIPCION'];
			$categoriaProducto = $fila['CATEGORIA'];
			$precioProducto = $fila['PRECIO'];
			$usuarioSubida = $fila['NOMBRE'];
			$idUsuarioSubida = $fila['ID_CLIENTE'];
		}

		mysqli_close($conexion);

		if(!empty($_POST['buscador'])){
			$busqueda = $_POST['busqueda'];
			header("Location: buscador.php?busqueda=$busqueda");
		}

		if(isset($_POST['comprar'])){
			if(!empty($_SESSION['id_Usuario'])){
				if($idUsuarioSubida == $_SESSION['id_Usuario']){
					echo "<script>alert('No puedes comprar un producto propio');</script>";
				}else{
					header("Location: comprar.php?idProducto=$idProducto");
				}
			}else{
				echo "<script>alert('Debes iniciar sesión para comprar');</script>";
			}
		}

		if(isset($_POST['listaDeseos'])){
			if(!empty($_SESSION['id_Usuario'])){
				$id_Usuario = $_SESSION['id_Usuario'];
				
				$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("No se pudo conectar al servidor");
				mysqli_set_charset($conexion, 'utf8');

				$consultaDeseos = mysqli_query($conexion, "SELECT * FROM deseos WHERE ID_CLIENTE ='" . $id_Usuario . "' AND ID_PRODUCTO='" . $idProducto . "'") or die("Error en la consulta");
				$nFilasDeseos = mysqli_num_rows($consultaDeseos);
				$filaDeseo = mysqli_fetch_array($consultaDeseos);

				if($nFilasDeseos > 0){
					echo "<script>alert('Ya existe este producto en tu lista de deseos');</script>";
				}else{
					$consultaExiste = mysqli_query($conexion, "SELECT * FROM producto WHERE ID_CLIENTE='" . $id_Usuario . "' AND ID_PRODUCTO='" . $idProducto . "'") or die("Error en la consulta de existe");
					$nFilasExiste = mysqli_num_rows($consultaExiste);

					if($nFilasExiste > 0){
						echo "<script>alert('No puedes añadir un producto propio a la lista');</script>";
					}else{
						$fecha_deseo = date('Y-m-d');
						$consultaInsert = mysqli_query($conexion, "INSERT INTO deseos(ID_CLIENTE, ID_PRODUCTO, FECHA_DESEO) VALUES('$id_Usuario', '$idProducto', '$fecha_deseo')") or die("Error en la inserción");
						if($consultaInsert){
							echo "<script>alert('Producto añadido a la lista de deseos');</script>";
						}	
					}					
				}

				mysqli_close($conexion);

			}else{
				echo "<script>alert('Inicia sesión para añadir productos');</script>";
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

						<form action="" method="post">
							<br/>
							<input type="submit" name="comprar" value="Comprar" class="btn btn-primary w-100">
						</form>
					</figure>
				</div>

				<div class="col-9 p-3">
					<ul class="list-group">
						<li class="list-group-item"><span class="font-weight-bold">Descripción del Producto</span></li>
						<?php 
							if(!empty($descripcionProducto)){ echo "<li class='list-group-item'><span>" . $descripcionProducto . "</span></li>";}
						?>
						<li class="list-group-item"><span class="font-weight-bold">Categoría del Producto</span></li>
						<?php 
							if(!empty($categoriaProducto)){ echo "<li class='list-group-item'><span>" . $categoriaProducto . "</span></li>";}
						?>
						<li class="list-group-item"><span class="font-weight-bold">Precio del Producto</span></li>
						<?php 
							if(!empty($precioProducto)){ echo "<li class='list-group-item'><span>" . $precioProducto . "€</span></li>";}
						?>
						<li class="list-group-item"><span class="font-weight-bold">Subido por</span></li>
						<?php 
							if(!empty($idUsuarioSubida)){ echo "<li class='list-group-item'><span>" . $usuarioSubida . "<a href='perfilUsuario.php?idUsuarioSubida=" . $idUsuarioSubida . "' class='btn btn-primary float-right'>Ver Perfil</a></span></li>";}
							//echo "<li class='list-group-item'><span>" . $idUsuarioSubida . "</span></li>";
						?>
						<li class="list-group-item">
							<form action="" method="post" class="float-right">
								<input type="submit" name="listaDeseos" value="Añadir a la lista de deseos" class="btn btn-primary">
							</form>
						</li>
						
					</ul>
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