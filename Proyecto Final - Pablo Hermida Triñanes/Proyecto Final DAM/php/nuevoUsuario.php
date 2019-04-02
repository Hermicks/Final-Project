<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
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

		$email = "";
		$pass = "";
		$passConfirm = "";
		$nombre = "";
		$apellidos = "";
		$dni = "";
		$sexo = "";
		$domicilio = "";
		$fecha_nacimiento = "";
		$fecha_creacion = "";
		$erroresForm = " - ";

		if(isset($_POST['nuevoUsuario'])){
            $email = $_POST['email'];
			$pass = $_POST['pass'];
			$passConfirm = $_POST['passConfirm'];
			$nombre = $_POST['nombre'];
			$apellidos = $_POST['apellidos'];
			$dni = $_POST['dni'];
			$sexo = $_POST['sexo'];
			$domicilio = $_POST['direccion'] . ", " . $_POST['codigoPostal'] . ", " . $_POST['ciudad'] . ", " . $_POST['provincia'] . ", " . $_POST['pais'];
			$fecha_nacimiento = $_POST['nacimiento'];
			$fecha_creacion = date('Y-m-d');

			$nombreImg = $_FILES['image']['name'];
			$TMPImg = $_FILES['image']['tmp_name'];
			$tamañoFichero = $_FILES['image']['size'];
            $errores = $_FILES['image']['error'];
            $limite = $_POST['limit'];

            if(strlen($pass) < 6){
            	$erroresForm = $erroresForm . "La contraseña tiene que tener al menos 6 caracteres - ";
            }

            if(strlen($passConfirm) < 6){
            	$erroresForm = $erroresForm . "La contraseña de confirmación tiene que tener al menos 6 caracteres - ";
            }

            $letra = substr($dni, -1);
			$numeros = substr($dni, 0, -1);
			if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){

			}else{
				$erroresForm = $erroresForm . "El dni no es válido - ";
			}

            if(is_numeric($_POST['direccion'])){
            	$erroresForm = $erroresForm . "La dirección no puede ser un número - ";
            }

            if(!is_numeric($_POST['codigoPostal']) || strlen($_POST['codigoPostal']) != 5){
            	$erroresForm = $erroresForm . "El código postal debe ser un número de cinco dígitos - ";
            }

            if(is_numeric($_POST['ciudad'])){
            	$erroresForm = $erroresForm . "La ciudad no puede ser un número - ";
            }

            if(is_numeric($_POST['provincia'])){
            	$erroresForm = $erroresForm . "La provincia no puede ser un número - ";
            }

            if(is_numeric($_POST['pais'])){
            	$erroresForm = $erroresForm . "El país no puede ser un número";
            }

            if($erroresForm == " - "){
            	if($pass == $passConfirm){
            	$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("Fallo en el servidor");
            	mysqli_set_charset($conexion, 'utf8');

            	$consulta = mysqli_query($conexion, "INSERT INTO cliente (NOMBRE, APELLIDOS, DNI, SEXO, DIRECCION, EMAIL, PWD, FECHA_NACIMIENTO, img, FECHA_CREACION) VALUES('$nombre', '$apellidos', '$dni', '$sexo', '$domicilio', '$email', '$pass', '$fecha_nacimiento', '$nombreImg', '$fecha_creacion')") or die("Error en la consulta de inserción");

	            	if($consulta){

		            	if(is_uploaded_file($_FILES['image']['tmp_name']) && $limite >= $tamañoFichero){
		            		$nombreDirectorio = "C:/xampp/htdocs/Proyecto Final DAM/Img Usuarios/";
		            		$nombreCompleto = $nombreDirectorio . $nombreImg;

		            		move_uploaded_file($TMPImg, $nombreCompleto);
		            		mysqli_close($conexion);
		            		echo "<script>alert('Has creado correctamente tu usuario');</script>";
		            		header("Location: inicioSesion.php");
		            	}else{
							echo "<script>
									alert('Archivo subido incorrectamente. Puede que el archivo sea demasiado pesado, sube otra imagen más ligera');
								</script>";
							mysqli_close($conexion);
						}
	            	}           	
            	}else{
            		echo "<script>
									alert('Las contraseñas deben coincidir');
								</script>";
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
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-10 m-5 p-3" id="formuStyle">

					<h3>Nuevo Usuario</h3>
					<hr/>
					<form method="post" action="nuevoUsuario.php" enctype="multipart/form-data">
						<label for="email" class="font-weight-bold">Email</label>
						<input type="email" id="email" name="email" class="form-control" required>

						<label for="pass" class="font-weight-bold">Contraseña</label>
						<input type="password" id="pass" name="pass" class="form-control" required>

						<label for="passConfirm" class="font-weight-bold m-1">Confirma la contraseña</label>
						<input type="password" id="passConfirm" name="passConfirm" class="form-control" required>

						<div class="float-right small">	
							<img src="../img/icons8-about-26.png" class="m-1"><span>La contraseña debe incluir al menos 6 caracteres</span>
						</div>
						
						<br>
						<hr/>

						<h5>Datos personales</h5>
						<label for="nombre">Nombre</label>
						<input type="text" id="nombre" name="nombre" class="form-control" required>

						<label for="apellidos">Apellidos</label>
						<input type="text" id="apellidos" name="apellidos" class="form-control" required>

						<label for="dni">DNI/NIF</label>
						<input type="text" id="dni" name="dni" class="form-control" required>

						<label for="nacimiento">Fecha de Nacimiento</label>
        				<input class="form-control" id="nacimiento" name="nacimiento" type="date"/ required>

						<label for="sexo">Sexo</label>
						<br>
						<select name="sexo" required>
							<option value="">Seleccione una opción</option>
							<option value="">Hombre</option>
							<option value="">Mujer</option>
						</select>

						<br/>
						<br/>
						<label for="image">Sube una imagen de perfil</label>
						<br/>
						<input type="hidden" name="limit" value="5000000">
						<input type="file" id="image" name="image" required>

						<br>
						<hr/>

						<h5>Domicilio</h5>
						<label for="direccion">Direccion</label>
						<input type="text" id="direccion" name="direccion" class="form-control" placeholder="Calle, Número, Letra, Escalera..." required>

						<div class="d-flex justify-content-between m-2">
							<label for="codigoPostal">Código Postal
							<input type="text" id="codigoPostal" name="codigoPostal" class="form-control" required></label>

							<label for="ciudad">Ciudad
							<input type="text" id="ciudad" name="ciudad" class="form-control" requiredrequired></label>

							<label for="provincia">Provincia
							<input type="text" id="provincia" name="provincia" class="form-control" required></label>

							<label for="pais">País
							<input type="text" id="pais" name="pais" class="form-control" required></label>
						</div>

						<br>
						<hr/>

						<input type="submit" id="nuevoUsuario" name="nuevoUsuario" value="Crear tu cuenta de NxT Tech" class="btn btn-success w-100">

						<span class="small m-2 float-right">* Al identificarte, aceptas nuestras <a href="#">Condiciones de uso</a>, nuestro <a href="#">Aviso de privacidad</a> y nuestras <a href="#">Condiciones de Cookies y publicidad en Internet</a>.</span>
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
										<label for="usuario">Nombre de usuario</label><input type="text" id="usuario" class="form-control" >
										<label for="email">Email</label><input type="email" id="email" class="form-control" >
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