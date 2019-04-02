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
		.cuerpoCard > h3{
			font-size: 17pt;
			visibility: visible;
		}
		@media(min-width: 526px){
			#filtroStyle{
				height: 500px;
			}
			.cuerpoCard > span{
				visibility: hidden;
			}
		}
		@media(min-width: 768px){
			#filtroStyle{
				height: 330px;
			}
			.cuerpoCard > span{
				visibility: visible;
			}
		}
	</style>
	<script type="text/javascript">
		function seleccionarPrecio(){
			var precio = document.getElementById('precio').value;
			location.href = "fotografiaVideo.php?precio=" + precio;
		}
	</script>
</head>
<body>
	<?php
		$busqueda = "";
		if(!empty($_POST['buscador'])){
			$busqueda = $_POST['busqueda'];
			header("Location: buscador.php?busqueda=$busqueda");
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

	<?php 
		$precio = "-1";
		if(isset($_GET['precio'])){
        	$precio = $_GET['precio'];
		}
	?>

	<section>
		<div class="container p-5">
			<div class="row">
				<div class="col-3" id="filtroStyle">
					<h5 class="m-3 text-center">¿Cuánto te quieres gastar?</h5>
					<hr/>
					<div>
						<label for="precio" class="font-weight-bold">Selecciona una opción</label>
						<br>
						<select class="w-100" id="precio" name="precio" onchange="seleccionarPrecio()" size="4">
							<option value="0" <?PHP if($precio == "0") echo "selected" ?>>0€ - 15€</option>
							<option value="1" <?PHP if($precio == "1") echo "selected" ?>>15€ - 25€</option>
							<option value="2" <?PHP if($precio == "2") echo "selected" ?>>25€ - 50€</option>
							<option value="3" <?PHP if($precio == "3") echo "selected" ?>>50€ - 75€</option>
							<option value="4" <?PHP if($precio == "4") echo "selected" ?>>75€ - 100€</option>
							<option value="5" <?PHP if($precio == "5") echo "selected" ?>>100€ - 150€</option>
							<option value="6" <?PHP if($precio == "6") echo "selected" ?>>> 150€</option>
						</select>
						<hr/>
						<span class="font-weight-bold text-center">Los mejores productos y al mejor precio</span>
					</div>
				</div>

				<div class="col-9">
					<?php
						$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("No se puede conectar al servidor");
						mysqli_set_charset($conexion, 'utf8');

						$consulta = mysqli_query($conexion, "SELECT * FROM producto WHERE CATEGORIA='Fotografia y Video'") or die("Error en la consulta");
						$nFilas = mysqli_num_rows($consulta);

						if($nFilas > 0){
							for($i = 0; $i < $nFilas; $i++){
								$fila = mysqli_fetch_array($consulta);
								if($precio == "0"){
									if($fila['PRECIO'] <= 15){
										echo "
										<div class='col-12'>
											<div class='card'>
												<div class='card-header'>
													<p class='big font-weight-bold text-center'>" . $fila['CATEGORIA'] . "</p>
												</div>

												<figure class='mx-auto'>
													<img src='../Productos Subidos/" . $fila['img'] . "' class='img-fluid p-1 imgCard'>
												</figure>

												<div class='card-body bg-primary cuerpoCard'>
													<h3 class='card-title'>" . $fila['DESCRIPCION'] . "<a href='producto.php?idProducto=" . $fila['ID_PRODUCTO'] . "' class='float-right btn btn-warning'>VER</a></h3>
													<span>Fecha de Subida: " . $fila['FECHA_SUBIDA'] . "</span>
													<span class='float-right'>Precio: " . $fila['PRECIO'] . "€</span>
												</div>
											</div>
										</div>
										";
									}
								}else if($precio == "1"){
									if($fila['PRECIO'] <= 25 && $fila['PRECIO'] >=15){
										echo "
										<div class='col-12'>
											<div class='card'>
												<div class='card-header'>
													<p class='big font-weight-bold text-center'>" . $fila['CATEGORIA'] . "</p>
												</div>

												<figure class='mx-auto'>
													<img src='../Productos Subidos/" . $fila['img'] . "' class='img-fluid p-1 imgCard'>
												</figure>

												<div class='card-body bg-primary cuerpoCard'>
													<h3 class='card-title'>" . $fila['DESCRIPCION'] . "<a href='producto.php?idProducto=" . $fila['ID_PRODUCTO'] . "' class='float-right btn btn-warning'>VER</a></h3>
													<span>Fecha de Subida: " . $fila['FECHA_SUBIDA'] . "</span>
													<span class='float-right'>Precio: " . $fila['PRECIO'] . "€</span>
												</div>
											</div>
										</div>
										";
									}
								}else if($precio == "2"){
									if($fila['PRECIO'] <= 50 && $fila['PRECIO'] >= 25){
										echo "
										<div class='col-12'>
											<div class='card'>
												<div class='card-header'>
													<p class='big font-weight-bold text-center'>" . $fila['CATEGORIA'] . "</p>
												</div>

												<figure class='mx-auto'>
													<img src='../Productos Subidos/" . $fila['img'] . "' class='img-fluid p-1 imgCard'>
												</figure>

												<div class='card-body bg-primary cuerpoCard'>
													<h3 class='card-title'>" . $fila['DESCRIPCION'] . "<a href='producto.php?idProducto=" . $fila['ID_PRODUCTO'] . "' class='float-right btn btn-warning'>VER</a></h3>
													<span>Fecha de Subida: " . $fila['FECHA_SUBIDA'] . "</span>
													<span class='float-right'>Precio: " . $fila['PRECIO'] . "€</span>
												</div>
											</div>
										</div>
										";
									}
								}else if($precio == "3"){
									if($fila['PRECIO'] <= 75 && $fila['PRECIO'] >= 50){
										echo "
										<div class='col-12'>
											<div class='card'>
												<div class='card-header'>
													<p class='big font-weight-bold text-center'>" . $fila['CATEGORIA'] . "</p>
												</div>

												<figure class='mx-auto'>
													<img src='../Productos Subidos/" . $fila['img'] . "' class='img-fluid p-1 imgCard'>
												</figure>

												<div class='card-body bg-primary cuerpoCard'>
													<h3 class='card-title'>" . $fila['DESCRIPCION'] . "<a href='producto.php?idProducto=" . $fila['ID_PRODUCTO'] . "' class='float-right btn btn-warning'>VER</a></h3>
													<span>Fecha de Subida: " . $fila['FECHA_SUBIDA'] . "</span>
													<span class='float-right'>Precio: " . $fila['PRECIO'] . "€</span>
												</div>
											</div>
										</div>
										";
									}
								}else if($precio == "4"){
									if($fila['PRECIO'] <= 100 && $fila['PRECIO'] >= 75){
										echo "
										<div class='col-12'>
											<div class='card'>
												<div class='card-header'>
													<p class='big font-weight-bold text-center'>" . $fila['CATEGORIA'] . "</p>
												</div>

												<figure class='mx-auto'>
													<img src='../Productos Subidos/" . $fila['img'] . "' class='img-fluid p-1 imgCard'>
												</figure>

												<div class='card-body bg-primary cuerpoCard'>
													<h3 class='card-title'>" . $fila['DESCRIPCION'] . "<a href='producto.php?idProducto=" . $fila['ID_PRODUCTO'] . "' class='float-right btn btn-warning'>VER</a></h3>
													<span>Fecha de Subida: " . $fila['FECHA_SUBIDA'] . "</span>
													<span class='float-right'>Precio: " . $fila['PRECIO'] . "€</span>
												</div>
											</div>
										</div>
										";
									}
								}else if($precio == "5"){
									if($fila['PRECIO'] <= 150 && $fila['PRECIO'] >= 100){
										echo "
										<div class='col-12'>
											<div class='card'>
												<div class='card-header'>
													<p class='big font-weight-bold text-center'>" . $fila['CATEGORIA'] . "</p>
												</div>

												<figure class='mx-auto'>
													<img src='../Productos Subidos/" . $fila['img'] . "' class='img-fluid p-1 imgCard'>
												</figure>

												<div class='card-body bg-primary cuerpoCard'>
													<h3 class='card-title'>" . $fila['DESCRIPCION'] . "<a href='producto.php?idProducto=" . $fila['ID_PRODUCTO'] . "' class='float-right btn btn-warning'>VER</a></h3>
													<span>Fecha de Subida: " . $fila['FECHA_SUBIDA'] . "</span>
													<span class='float-right'>Precio: " . $fila['PRECIO'] . "€</span>
												</div>
											</div>
										</div>
										";
									}
								}else if($precio == "6"){
									if($fila['PRECIO'] >= 150){
										echo "
										<div class='col-12'>
											<div class='card'>
												<div class='card-header'>
													<p class='big font-weight-bold text-center'>" . $fila['CATEGORIA'] . "</p>
												</div>

												<figure class='mx-auto'>
													<img src='../Productos Subidos/" . $fila['img'] . "' class='img-fluid p-1 imgCard'>
												</figure>

												<div class='card-body bg-primary cuerpoCard'>
													<h3 class='card-title'>" . $fila['DESCRIPCION'] . "<a href='producto.php?idProducto=" . $fila['ID_PRODUCTO'] . "' class='float-right btn btn-warning'>VER</a></h3>
													<span>Fecha de Subida: " . $fila['FECHA_SUBIDA'] . "</span>
													<span class='float-right'>Precio: " . $fila['PRECIO'] . "€</span>
												</div>
											</div>
										</div>
										";
									}
								}else if($precio == "-1"){
									echo "
										<div class='col-12'>
											<div class='card'>
												<div class='card-header'>
													<p class='big font-weight-bold text-center'>" . $fila['CATEGORIA'] . "</p>
												</div>

												<figure class='mx-auto'>
													<img src='../Productos Subidos/" . $fila['img'] . "' class='img-fluid p-1 imgCard'>
												</figure>

												<div class='card-body bg-primary cuerpoCard'>
													<h3 class='card-title'>" . $fila['DESCRIPCION'] . "<a href='producto.php?idProducto=" . $fila['ID_PRODUCTO'] . "' class='float-right btn btn-warning'>VER</a></h3>
													<span>Fecha de Subida: " . $fila['FECHA_SUBIDA'] . "</span>
													<span class='float-right'>Precio: " . $fila['PRECIO'] . "€</span>
												</div>
											</div>
										</div>
										";
								}
							}
						}
					?>
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