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
		$idUsuario = $_SESSION['id_Usuario'];

		$descripcion = "";
		$categoria = "";
		$modelo = "";
		$precio = "";
		$fecha = "";
		$erroresForm = " - ";

		if(isset($_POST['nuevoProducto'])){
			$descripcion = $_POST['descripcion'];
			$categoria = $_POST['categoria'];
			$modelo = $_POST['modelo'];
			$precio = $_POST['precio'];
			$fecha = date('Y-m-d');

			$nombreIMG = $_FILES['imgProduct']['name'];
			$TMPImg = $_FILES['imgProduct']['tmp_name'];
			$tamañoImg = $_FILES['imgProduct']['size'];
			$limite = $_POST['limit'];

			if(!is_numeric($precio)){
				$erroresForm = $erroresForm . "El precio debe ser numérico";
			}

			if($erroresForm == " - "){
				$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("No se puede conectar al servidor");
				mysqli_set_charset($conexion, 'utf8');

				$consulta = mysqli_query($conexion, "INSERT INTO producto(ID_CLIENTE, DESCRIPCION, CATEGORIA, MODELO, PRECIO, CANTIDAD, img, FECHA_SUBIDA) VALUES('$idUsuario', '$descripcion', '$categoria', '$modelo', '$precio', '1', '$nombreIMG', '$fecha')") or die("Fallo en la consulta de inserción");

				if($consulta){
					if(is_uploaded_file($TMPImg) && $limite >= $tamañoImg){
						$nombreDirectorio = "C:/xampp/htdocs/Proyecto Final DAM/Productos Subidos/";
						$nombreCompleto = $nombreDirectorio . $nombreIMG;

						move_uploaded_file($TMPImg, $nombreCompleto);
						mysqli_close($conexion);
						echo "<script>alert('Has subido correctamente tu producto');</script>";
	            		header("Location: panelUsuario.php");
					}else{
						echo "<script>
								alert('Archivo subido incorrectamente. Puede que el archivo sea demasiado pesado, sube otra imagen más ligera');
							</script>";
						mysqli_close($conexion);
					}
				}
			}else{
				echo "<script>alert('" . $erroresForm . "');</script>";
			}
		}
	?>

	<section>
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-10 m-5 p-3" id="formuStyle">
					<h3>Subir Producto</h3>
					<hr/>
					<form action="" method="post" enctype="multipart/form-data">
						<label for="descripcion" class="font-weight-bold">Descripción</label>
						<input type="text" name="descripcion" class="form-control" required>

						<label for="categoria" class="font-weight-bold">Categoria</label>
						<br/>
						<select name="categoria" required>
							<option value="">Seleccione una opción</option>
							<option value="Videojuegos y Consolas">Videojuegos y Consolas</option>
							<option value="Moviles y Tablets">Móviles y Tablets</option>
							<option value="Fotografia y Video">Fotografía y Vídeo</option>
						</select>
						<br/>
						<br/>

						<label for="modelo" class="font-weight-bold">Modelo</label>
						<input type="text" name="modelo" class="form-control" placeholder="Nikon D500, iPhone X, Videojuego..." required>

						<label for="precio" class="font-weight-bold">Precio</label>
						<input type="text" name="precio" class="form-control" required>

						<label for="imgProduct" class="font-weight-bold">Imagen producto</label>
						<br/>
						<input type="hidden" name="limit" value="5000000">
						<input type="file" name="imgProduct" required>

						<br/>
						<hr/>

						<input type="submit" name="nuevoProducto" value="Añade un nuevo producto" class="btn btn-success w-100">

						<hr/>

						<a href="panelUsuario.php" class="btn btn-primary w-100">Volver</a>
					</form>
				</div>
			<div>
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