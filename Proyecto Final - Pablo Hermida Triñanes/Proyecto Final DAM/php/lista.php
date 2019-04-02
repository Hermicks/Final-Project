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
		#entrada{
			height: 500px;
			background-image: url(../img/fondo.jpeg);
			background-position: center center;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
	</style>
</head>
<body>
	<?php
		$busqueda = "";
		$idDragon = "";
		$idZelda = "";
		$idGod = "";
		$idPlay = "";
		$idXbox = "";
		$idSwitch = "";
		$idIphone = "";
		$idSamsung = "";
		$idLenovo = "";
		$idNikon = "";
		$idNK = "";
		$idCanon = "";
		if(!empty($_POST['buscador'])){
			$busqueda = $_POST['busqueda'];
			header("Location: buscador.php?busqueda=$busqueda");
		}

		$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("Error al conectar con el servidor");
		mysqli_set_charset($conexion, 'utf8');

		$consultaDragon = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Dragon Ball Fighter Z%'") or die("Error en la consulta de Dragon Ball");
		$filaDragon = mysqli_fetch_array($consultaDragon);
		$idDragon = $filaDragon['ID_PRODUCTO'];

		$consultaZelda = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Zelda Breath Of The Wild%'") or die("Error en la consulta de Zelda");
		$filaZelda = mysqli_fetch_array($consultaZelda);
		$idZelda = $filaZelda['ID_PRODUCTO'];

		$consultaGod = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%God Of War%'") or die("Error en la consulta de God Of War");
		$filaGod = mysqli_fetch_array($consultaGod);
		$idGod = $filaGod['ID_PRODUCTO'];

		$consultaPlay = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%PlayStation 4%'") or die("Error en la consulta de PlayStation");
		$filaPlay = mysqli_fetch_array($consultaPlay);
		$idPlay = $filaPlay['ID_PRODUCTO'];

		$consultaXbox = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%XBox One X%'") or die("Error en la consulta de XBox");
		$filaXBox = mysqli_fetch_array($consultaXbox);
		$idXbox = $filaXBox['ID_PRODUCTO'];

		$consultaSwitch = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Nintendo Switch%'") or die("Error en la consulta de Nintendo Switch");
		$filaSwitch = mysqli_fetch_array($consultaSwitch);
		$idSwitch = $filaSwitch['ID_PRODUCTO'];

		$consultaIphone = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%iPhone X%'") or die("Error en la consulta de iPhone X");
		$filaIphone = mysqli_fetch_array($consultaIphone);
		$idIphone = $filaIphone['ID_PRODUCTO'];

		$consultaSamsung = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Samsung Galaxy S8%'") or die("Error en la consulta de Samsung Galaxy");
		$filaSamsung = mysqli_fetch_array($consultaSamsung);
		$idSamsung = $filaSamsung['ID_PRODUCTO'];

		$consultaLenovo = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Lenovo Yoga%'") or die("Error en la consulta de Lenovo Yoga");
		$filaLenovo = mysqli_fetch_array($consultaLenovo);
		$idLenovo = $filaLenovo['ID_PRODUCTO'];

		$consultaNikon = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Nikon D5300%'") or die("Error en la consulta de Nikon");
		$filaNikon = mysqli_fetch_array($consultaNikon);
		$idNikon = $filaNikon['ID_PRODUCTO'];

		$consultaNK = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%NK Zeta Dark%'") or die("Error en la consulta de NK");
		$filaNK = mysqli_fetch_array($consultaNK);
		$idNK = $filaNK['ID_PRODUCTO'];

		$consultaCanon = mysqli_query($conexion, "SELECT ID_PRODUCTO from producto WHERE DESCRIPCION like '%Canon T6%'") or die("Error en la consulta de Canon");
		$filaCanon = mysqli_fetch_array($consultaCanon);
		$idCanon = $filaCanon['ID_PRODUCTO'];

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

	<div id="entrada"></div>
	
	<section>
		<div class="container">
			<h4 class="m-4">Los videojuegos de la semana</h4>
			<div class="row p-5">
				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Videojuegos y Consolas</p>
						</div>

						<figure class="mx-auto">
							<img src="../Productos Subidos/dragon.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-primary cuerpoCard">
							<h3 class="card-title text-center">Dragon Ball FighterZ</h3>
							<a <?php if(!empty($idDragon)){ echo "href='producto.php?idProducto=" . $idDragon . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
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
							<h3 class="card-title text-center">Zelda Breath Of The Wild</h3>
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
							<img src="../Productos Subidos/god.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-primary cuerpoCard">
							<h3 class="card-title text-center">God Of War</h3>
							<a <?php if(!empty($idGod)){ echo "href='producto.php?idProducto=" . $idGod . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>
			</div>
			
			<hr/>

			<h4 class="m-4">Las consolas de la semana</h4>
			<div class="row p-5">
				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Videojuegos y Consolas</p>
						</div>

						<figure class="mx-auto cuerpoImg">
							<img src="../Productos Subidos/play.jpeg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-success cuerpoCard">
							<h3 class="card-title text-center">PlayStation 4</h3>
							<a <?php if(!empty($idPlay)){ echo "href='producto.php?idProducto=" . $idPlay . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Videojuegos y Consolas</p>
						</div>

						<figure class="mx-auto">
							<img src="../Productos Subidos/xbox.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-success cuerpoCard">
							<h3 class="card-title text-center">Xbox One X</h3>
							<a <?php if(!empty($idXbox)){ echo "href='producto.php?idProducto=" . $idXbox . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Videojuegos y Consolas</p>
						</div>

						<figure class="mx-auto">
							<img src="../Productos Subidos/switch.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-success cuerpoCard">
							<h3 class="card-title text-center">Nintendo Switch</h3>
							<a <?php if(!empty($idSwitch)){ echo "href='producto.php?idProducto=" . $idSwitch . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>
			</div>

			<hr/>

			<h4 class="m-4">Los móviles y tablets de la semana</h4>
			<div class="row p-5">
				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Móviles y Tablets</p>
						</div>

						<figure class="mx-auto">
							<img src="../Productos Subidos/iphoneX.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-danger cuerpoCard">
							<h3 class="card-title text-center">iPhone X</h3>
							<a <?php if(!empty($idIphone)){ echo "href='producto.php?idProducto=" . $idIphone . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Móviles y Tablets</p>
						</div>

						<figure class="mx-auto">
							<img src="../Productos Subidos/samsungGalaxy.jpeg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-danger cuerpoCard">
							<h3 class="card-title text-center">Samsung Galaxy S8</h3>
							<a <?php if(!empty($idSamsung)){ echo "href='producto.php?idProducto=" . $idSamsung . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Móviles y Tablets</p>
						</div>

						<figure class="mx-auto"	>
							<img src="../Productos Subidos/lenovoYoga.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-danger cuerpoCard">
							<h3 class="card-title text-center">Lenovo Yoga</h3>
							<a <?php if(!empty($idLenovo)){ echo "href='producto.php?idProducto=" . $idLenovo . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>
			</div>

			<hr/>

			<h4 class="m-4">Las cámaras de la semana</h4>
			<div class="row p-5">
				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Fotografía y Vídeo</p>
						</div>

						<figure class="mx-auto">
							<img src="../Productos Subidos/nikonD5300.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-info cuerpoCard">
							<h3 class="card-title text-center">Nikon D5300</h3>
							<a <?php if(!empty($idNikon)){ echo "href='producto.php?idProducto=" . $idNikon . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Fotografía y Vídeo</p>
						</div>

						<figure class="mx-auto">
							<img src="../Productos Subidos/nk.png" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-info cuerpoCard">
							<h3 class="card-title text-center">NK Zeta-Dark</h3>
							<a <?php if(!empty($idNK)){ echo "href='producto.php?idProducto=" . $idNK . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<p class="big font-weight-bold text-center">Fotografía y Vídeo</p>
						</div>

						<figure class="mx-auto"	>
							<img src="../Productos Subidos/canon.jpg" class="img-fluid p-1 imgCard">
						</figure>

						<div class="card-body bg-info cuerpoCard">
							<h3 class="card-title text-center">Canon T6</h3>
							<a <?php if(!empty($idCanon)){ echo "href='producto.php?idProducto=" . $idCanon . "'";} ?> class="btn btn-warning" style="position: absolute; bottom: 5px; right: 10px;">VER</a>
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