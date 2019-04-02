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
		#botonApuntarse{
			margin: 8%;
			position: absolute;
			z-index: 100;
		}

		@media(min-width: 526px){
			#botonApuntarse{
				margin: 8%;
			}
		}

		@media(min-width: 1080px){
			.carruselItem{
				height: 500px;
			}
		}
	</style>
</head>
<body>
	<?php
		$busqueda = "";
		$idMario = "";
		$idZelda = "";
		$idDonkey = "";

		if(!empty($_POST['buscador'])){
			$busqueda = $_POST['busqueda'];
			header("Location: buscador.php?busqueda=$busqueda");
		}

		$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("Error al conectar con el servidor");
		mysqli_set_charset($conexion, 'utf8');

		$consultaMario = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Mario Kart Deluxe 8%'") or die("Error en la consulta de Mario");
		$filaMario = mysqli_fetch_array($consultaMario);
		$idMario = $filaMario['ID_PRODUCTO'];

		$consultaZelda = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Zelda Breath Of The Wild%'") or die("Error en la consulta de Zelda");
		$filaZelda = mysqli_fetch_array($consultaZelda);
		$idZelda = $filaZelda['ID_PRODUCTO'];

		$consultaDonkey = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Donkey Kong Country TF%'") or die("Error en la consulta de Donkey");
		$filaDonkey = mysqli_fetch_array($consultaDonkey);
		$idDonkey = $filaDonkey['ID_PRODUCTO'];

		mysqli_close($conexion);
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
		<div class="row">
			<p class="alert alert-success alert-dismissible" id="botonApuntarse">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<a href="nuevoUsuario.php"><strong>Regístrate ya!</strong></a>
			</p>
		</div>

		<div id="carouselIndex" class="carousel slide" data-ride="carousel">
			<ul class="carousel-indicators">
				<li data-target="#carouselIndex" data-slide-to="0" class="active"></li>
				<li data-target="#carouselIndex" data-slide-to="1"></li>
				<li data-target="#carouselIndex" data-slide-to="2"></li>
			</ul>

			<div class="carousel-inner" id="carrusel">
				<div class="carousel-item active carruselItem">
					<img src="../img/metroid.jpg" class="w-100">
						<div class="carousel-caption">
							<h3>Los mejores juegos al mejor precio</h3>
							<p>Busca el juego que desees o vendelo por la cantidad que busques</p>
						</div>
				</div>

				<div class="carousel-item carruselItem">
					<img src="../img/android.jpg" class="w-100 align-self-center">
						<div class="carousel-caption">
							<h3>Tablets y móviles de última gama</h3>
								<p>Las últimas novedades con la mayor garantía</p>
						</div>
				</div>

				<div class="carousel-item carruselItem">
					<img src="../img/camera.jpg" class="w-100">
						<div class="carousel-caption">
							<h3>¿Te gusta plasmar lo que ves?</h3>
							<p>Amplia ofertas de cámaras y videocámaras de última generación</p>
						</div>
				</div>
			</div>

			<a href="#carouselIndex" class="carousel-control-prev" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>

			<a href="#carouselIndex" class="carousel-control-next" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row m-5 text-center">
				<div class="col">
					<h2>Todo lo que deseas a tan solo un click</h2>
					<span>Amplio catálogo de productos para todo el mundo. Últimas tecnologías, así como grandes clásicos para los más coleccionistas</span>
				</div>
			</div>
			<hr/>
			<div class="row m-5 text-center">
				<div class="col">
					<h2>Fácil y sencillo</h2>
					<span>En NxT Tech te damos todas las facilidades posibles para que puedas vender y comprar sin ningún miedo</span>
				</div>
			</div>
			<hr/>
			<div class="row m-5 text-center">
				<div class="col">
					<h2>Sólo lo que buscas y necesitas</h2>
					<span>Acceso rápido y sencillo a todos aquellos productos que buscas. Y al mejor precio!</span>
				</div>
			</div>
			<hr/>
			<div class="row m-5 text-center">
				<div class="col">
					<h2>Atención personalizada</h2>
					<span>Cada uno de nuestros usuarios es único y por eso queremos darte el mayor apoyo y servicio posible con nuestra atención personalizada</span>
				</div>
			</div>
			<hr/>
		</div>
	</section>

	<section>
		<div class="container">
			<h2 class="text-center">Nuestros videojuegos favoritos</h2>
			<div class="row p-5">
				<div class="col-4">
					<div class="card">		
						<div class="card-header">
							<p class="big font-weight-bold text-center">Videojuegos y Consolas</p>
						</div>

						<figure class="mx-auto">
							<img src="../Productos Subidos/marioKart.png" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-primary cuerpoCard">
							<h3 class="card-title">Mario Kart Deluxe 8</h3>
							<a <?php if(!empty($idMario)){ echo "href='producto.php?idProducto=" . $idMario . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card">	
						<div class="card-header">
							<p class="big font-weight-bold text-center">Videojuegos y Consolas</p>
						</div>

						<figure class="mx-auto">
							<img src="../Productos Subidos/BOTW.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-primary cuerpoCard">
							<h3 class="card-title">Zelda Breath Of The Wild</h3>
							<a <?php if(!empty($idZelda)){ echo "href='producto.php?idProducto=" . $idZelda . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card">	
						<div class="card-header">
							<p class="big font-weight-bold text-center">Videojuegos y Consolas</p>
						</div>

						<figure class="mx-auto"	>
							<img src="../Productos Subidos/donkey.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-primary cuerpoCard">
							<h3 class="card-title">Donkey Kong Country TF</h3>
							<a <?php if(!empty($idDonkey)){ echo "href='producto.php?idProducto=" . $idDonkey . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
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