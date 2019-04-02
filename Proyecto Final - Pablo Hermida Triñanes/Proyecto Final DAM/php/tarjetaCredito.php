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

	@media(min-width: 263px){
		#imgCredito{
			visibility: hidden;
		}
	}

	@media(min-width: 526px){
		#imgCredito{
			visibility: hidden;
		}
	}

	@media(min-width: 768px){
		#imgCredito{
			visibility: hidden;
		}
	}

	@media(min-width: 1080px){
		#imgCredito{
			visibility: visible;
		}
	}
	</style>
</head>
<body>
	<?php
		$idUsario = "";
		$nTarjeta = "";
		$nSeguridad = "";
		$fechaCaducidad = "";
		$nombreTitular = "";
		$erroresForm = " - ";
		$busqueda = "";

		if(!empty($_POST['buscador'])){
			$busqueda = $_POST['busqueda'];
			header("Location: buscador.php?busqueda=$busqueda");
		}

		if(isset($_POST['nuevaTarjeta'])){
			$idUsario = $_SESSION['id_Usuario'];
			$nTarjeta = $_POST['numeroTarjeta'];
			$nSeguridad = $_POST['numeroSeguridad'];
			$fechaCaducidad = $_POST['mes'] . " / " . $_POST['anyo'];
			$nombreTitular = $_POST['nombreTitular'];

			if(!is_numeric($_POST['numeroTarjeta']) || strlen($_POST['numeroTarjeta']) != 16){
				$erroresForm = $erroresForm . "El número de tarjeta debe ser un número de dieciseis dígitos - ";
			}

			if(!is_numeric($_POST['numeroSeguridad']) || strlen($_POST['numeroSeguridad']) != 3){
				$erroresForm = $erroresForm . "El número de seguridad debe ser un número de 3 dígitos - ";
			}

			if(is_numeric($_POST['nombreTitular'])){
				$erroresForm = $erroresForm . "El nombre del titular no puede ser un número";
			}

			if($erroresForm == " - "){
				$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("Fallo en el servidor");
        		mysqli_set_charset($conexion, 'utf8');

        		$consulta = mysqli_query($conexion, "SELECT * from tarjeta WHERE ID_CLIENTE='" . $idUsario . "'") or die("No se puede ejecutar la consulta");
        		$nFilas = mysqli_num_rows($consulta);

        		if($nFilas > 0){
        			$Update = mysqli_query($conexion, "UPDATE tarjeta
        													SET NUMERO_TARJETA = '" . $nTarjeta .
        													"', NUMERO_SEGURIDAD = '" . $nSeguridad .
        													"', FECHA_CADUCIDAD = '" . $fechaCaducidad .
        													"', NOMBRE_TITULAR = '" . $nombreTitular .
        													"' WHERE ID_CLIENTE = '" . $idUsario . "'")
        													or die("Error en la consulta de actualizacion");

        			if($Update){
        				mysqli_close($conexion);
        				echo "<script>alert('Tarjeta actualizada');</script>";
        			}else{
        				mysqli_close($conexion);
        			}
        		}else{
        			$insert = mysqli_query($conexion, "INSERT INTO tarjeta(ID_CLIENTE, NUMERO_TARJETA, NUMERO_SEGURIDAD, FECHA_CADUCIDAD, NOMBRE_TITULAR) VALUES('$idUsario', '$nTarjeta', '$nSeguridad', '$fechaCaducidad', '$nombreTitular')") or die("Error en la inserción");
        			if($insert){
        				mysqli_close($conexion);
        				echo "<script>alert('Nueva tarjeta añadida');</script>";
        			}else{
        				mysqli_close($conexion);
        			}
        		}
			}else{
				echo "<script>alert('" . $erroresForm . "');</script>";
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
			<div class="row">

				<div class="col p-3" id="formuStyle">
					<h3>Tarjeta de Crédito</h3>
					<figure style="position: absolute; top: 0; right: 3%;">
						<img class="img-fluid float-right" src="../img/credit.jpg" id="imgCredito">
					</figure>
					<br/>
					<br/>
					<hr/>
					<form action="" method="post">
						<label for="numeroTarjeta" class="font-weight-bold">Número de Tarjeta</label>
						<input type="text" name="numeroTarjeta" class="form-control" required>
						<span class="small m-2 float-right font-weight-bold">* El número de tarjeta debe contener un total de 16 dígitos</span>
						<br/>

						<label for="numeroSeguridad" class="font-weight-bold">Número de Seguridad</label>
						<input type="text" name="numeroSeguridad" class="form-control" required>
						<span class="small m-2 float-right font-weight-bold">* El número de seguridad son los tres dígitos del reverso de la tarjeta</span>
						<br/>

						<label for="fechaCaducidad" class="font-weight-bold">Fecha Caducidad</label>
						<br/>
						<select name="mes" required>
							<?php 
								for($i = 1; $i < 13; $i++){
									echo "<option value='" . $i ."'>" . $i . "</option>";
								}
							?>
						</select>
						<?php echo " / "; ?>
						<select name="anyo" required>
							<?php 
								for($i = 2018; $i < 2100; $i++){
									echo "<option value='" . $i ."'>" . $i . "</option>";
								}
							?>
						</select>
						<br/>
						<br/>

						<label for="nombreTitular" class="font-weight-bold m-1">Nombre del Titular</label>
						<input type="text" name="nombreTitular" class="form-control" required>
						<br/>

						<input type="submit" name="nuevaTarjeta" value="Añadir Tarjeta" class="btn btn-success w-100">
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