<?php
	include_once 'gestionarDatos.php';
    include_once 'gestionBD.php';
	
	$idCliente = $_GET['IDCLIENTE'] ;
	$idViaje = $_GET['IDVIAJE'];
	$pago = $_GET['IDPAGO'];
	$conn = crearConexionBD();
	
	try{
	
		eliminaPago($conn,$pago);
		
		header('Location: index.php');
		
	}catch(PDOException $e){
		
		$_SESSION['borrado'] = "Ha habido un error";
		header('Location: index.php');
	}
	
	
	cerrarConexcionBD($conn);
	
	
	
?>