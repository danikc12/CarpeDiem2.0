<?php
	session_start();
	
	// HAY QUE IMPORTAR LA LIBRERÍA DE LA CONEXIÓN A BD
	
	require_once("gestionBD.php");
	
	// HAY QUE IMPORTAR LA LIBRERIA DEL CRUD DE USUARIOS
	
	require_once("gestionarDatos.php");
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION['formulario'])) {
		print_r($_SESSION['formulario']);
		$pago = $_SESSION['formulario'];
		unset($_SESSION['formulario']); 
		$_SESSION['errores'] = null;
	}
	else {
		Header("Location: pagos.php");	
	
	}
	// ABRIR LA CONEXIÓN A LA BASE DE DATOS
	//...
	
	
	$conexion = crearConexionBD();

		
// AQUÍ SE INVOCA A LA FUNCIÓN DE ALTA DE USUARIO
				// EN EL CONTEXTO DE UNA SENTENCIA IF
				
				$fecha = date('d/m/Y',strtotime("today"));
				
				print_r($pago);
				if (nuevoPago($conexion, $pago,$fecha)) {
					$error = FALSE;	
					$_SESSION['usuario'] = $nuevoCliente['nombre'];
				}
				else {
					$error = TRUE;
				}
				$_SESSION['error'] = $error;
				Header('Location: index.php');
				
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conexion);
?>
