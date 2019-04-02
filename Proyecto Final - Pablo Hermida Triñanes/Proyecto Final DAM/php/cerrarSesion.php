<?php 
	session_start();
	unset($_SESSION['id_Usuario']);
	session_destroy();
	header("Location: inicioSesion.php");
	exit();
?>