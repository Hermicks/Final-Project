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
		#categoriaSelect{
			background-color: #D6CFCF;
		}
		#tablaCompras{
			margin: 15px;
			height: 300px;
		}
		#tablaCompras h2{
			color: black;
			font-size: 12pt;
			font-style: italic;
			font-weight: bold;
			padding: 15px;
		}
		#tablaCompras h3{
			color: black;
			font-size: 10pt;
			font-weight: bold;
			padding: 15px;
		}
	</style>
	<script type="text/javascript">
		function seleccionarIndice(){
				var seleccion = document.getElementById('categoria').value;
				location.href = "historialPedidos.php?categoria=" + seleccion;
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
		$categoria = "Todos";
		if(isset($_GET['categoria'])){
        	$categoria = $_GET['categoria'];
		}
	?>

	<section>
		<div class="container">
			<div class="row">	
				<div class="col p-5" id="categoriaSelect">	
						<select id="categoria" onchange="seleccionarIndice()">
							<option value="Todos" <?PHP if($categoria == "Todos") echo "selected" ?>>Todos</option>
							<option value="Videojuegos y Consolas" <?PHP if($categoria == "Videojuegos y Consolas") echo "selected" ?>>Videojuegos y Consolas</option>
							<option value="Moviles y Tablets" <?PHP if($categoria == "Moviles y Tablets") echo "selected" ?>>Moviles y Tablets</option>
							<option value="Fotografia y Video" <?PHP if($categoria == "Fotografia y Video") echo "selected" ?>>Fotografia y Video</option>
						</select>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<?php 
					$id_Usuario = "";

					if(!empty($_SESSION['id_Usuario'])){
						$id_Usuario = $_SESSION['id_Usuario'];

						$conexion = mysqli_connect("localhost", "root", "", "nxttexh") or die("Error al conectar con el servidor");
						mysqli_set_charset($conexion, 'utf8');

						$consulta = mysqli_query($conexion, "SELECT * FROM transacciones WHERE ID_CLIENTE='" . $id_Usuario . "'") or die("Error en la consulta");
						$nFilas = mysqli_num_rows($consulta);

						if($nFilas > 0){
							echo "<table id='tablaCompras' class='table table-info table-striped table-bordered table-hover table-responsive-xs'>";
							echo "<tr><th><h2>Artículo</h2></th><th><h2>Categoría</h2></th><th><h2>Precio</h2></th><th><h2>Fecha Compra</h2></th><th><h2>Dirección</h2></th><th><h2>Método de Pago</h2></th></tr>";
								for ($i=0; $i < $nFilas; $i++) { 
									$fila = mysqli_fetch_array($consulta);
									if($fila['CATEGORIA'] == $categoria){
										echo "<tr>";
											echo "<td><h3>" . $fila['DESCRIPCION'] . "</h3></td>";
											echo "<td><h3>" . $fila['CATEGORIA'] . "</h3></td>";
											echo "<td><h3>" . $fila['PRECIO'] . "€</h3></td>";
											echo "<td><h3>" . $fila['FECHA_COMPRA'] . "</h3></td>";
											echo "<td><h3>" . $fila['DIRECCION'] . "</h3></td>";
											echo "<td><h3>" . $fila['METODO_PAGO'] . "</h3></td>";
										echo "</tr>";
									}else if($categoria == 'Todos'){
										echo "<tr>";
											echo "<td><h3>" . $fila['DESCRIPCION'] . "</h3></td>";
											echo "<td><h3>" . $fila['CATEGORIA'] . "</h3></td>";
											echo "<td><h3>" . $fila['PRECIO'] . "€</h3></td>";
											echo "<td><h3>" . $fila['FECHA_COMPRA'] . "</h3></td>";
											echo "<td><h3>" . $fila['DIRECCION'] . "</h3></td>";
											echo "<td><h3>" . $fila['METODO_PAGO'] . "</h3></td>";
										echo "</tr>";
									}
								}
							echo "</table>";
							mysqli_close($conexion);
						}else{
							mysqli_close($conexion);
							echo "<script>alert('No has comprado ningún artículo');</script>";
							echo "<div style='height:300px;'></div>";
						}
					}
				?>
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