<?php
	session_start();
	
	// HAY QUE IMPORTAR LA LIBRERÍA DE LA CONEXIÓN A BD
	
	require_once("gestionBD.php");
	
	// HAY QUE IMPORTAR LA LIBRERIA DEL CRUD DE USUARIOS
	
	require_once("gestionarCliente.php");
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION['formulario'])) {
		$nuevoCliente = $_SESSION['formulario'];
		unset($_SESSION['formulario']);
		$_SESSION['errores'] = null;
	}
	else {
		Header("Location: anyadirCliente.php");	
	
	}
	// ABRIR LA CONEXIÓN A LA BASE DE DATOS
	//...
	
	
	$conexion = crearConexionBD();
	
	

	// Función para formatear una fecha al formato de Oracle
	function getFechaFormateada($fecha){
		$fechaNacimiento = date('d/m/Y', strtotime($fecha));
		return $fechaNacimiento;
	}





	
		
// AQUÍ SE INVOCA A LA FUNCIÓN DE ALTA DE USUARIO
				// EN EL CONTEXTO DE UNA SENTENCIA IF
				
				if (alta_cliente($conexion, $nuevoCliente)) {
					$error = FALSE;	
					$_SESSION['usuario'] = $nuevoCliente['nombre'];
				}
				else {
					$error = TRUE;
				}
				$_SESSION['error'] = $error;
				Header('Location: anyadirCliente.php');
				
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conexion);
?>
