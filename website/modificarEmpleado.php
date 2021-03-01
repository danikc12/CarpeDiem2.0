<?php
	include_once 'gestionarDatos.php';
    include_once 'gestionBD.php';
	
	$idEmpleado = $_GET['EMPLEADO'];
	$id = $_GET['ID'];
	$conn = crearConexionBD();
	
	
	if($id == 1){
	
	try{
	
		darBaja($conn,$idEmpleado);
		
		header('Location: empleados.php');
		
	}catch(PDOException $e){
		
		$_SESSION['borrado'] = "Ha habido un error";
		header('Location: empleados.php');
	}
	
		
	}else{
		
		try{
	
		darAlta($conn,$idEmpleado);
		
		header('Location: empleados.php');
		
		}catch(PDOException $e){
		
		$_SESSION['borrado'] = "Ha habido un error";
		header('Location: empleados.php');
	}
	
		
	}
	
	
	cerrarConexcionBD($conn);
	
	
	

?>