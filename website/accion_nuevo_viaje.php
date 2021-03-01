<?php
	session_start();
	
	// HAY QUE IMPORTAR LA LIBRERÍA DE LA CONEXIÓN A BD
	
	require_once("gestionBD.php");
	
	// HAY QUE IMPORTAR LA LIBRERIA DEL CRUD DE USUARIOS
	
	require_once("gestionarViaje.php");
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION['formulario'])) {
		$nuevoViaje = $_SESSION['formulario'];
		unset($_SESSION['formulario']);
		$_SESSION['errores'] = null;
		
	}
	else {
		Header("Location: anyadirViaje.php");	
	
	}
	// ABRIR LA CONEXIÓN A LA BASE DE DATOS
	//...
	
	
	$conexion = crearConexionBD();	
		
// AQUÍ SE INVOCA A LA FUNCIÓN DE ALTA DE USUARIO
				// EN EL CONTEXTO DE UNA SENTENCIA IF
				
				
		//alojamiento
		if (nuevo_Alojamiento($conexion, $nuevoViaje)) {
			$error = FALSE;	
			if(nuevo_viajeAlojamiento($conexion, $nuevoViaje)){
				$error = FALSE;
				if (nueva_actividad($conexion, $nuevoViaje)) {
					$error = FALSE;
					if(nuevo_viajeActividad($conexion, $nuevoViaje)){
						$error = FALSE;
						if(nueva_estacion($conexion, $nuevoViaje)){
							$error = FALSE;
							if(nuevo_transporte($conexion, $nuevoViaje)){
								$error = FALSE;
								if(nuevo_viaje($conexion, $nuevoViaje)){
									$error = FALSE;
								}else{
									$error = TRue;
								}
							}else{
								$error = TRUE;
							}
						}else{
							$error = TRUE;
						}
					}else{
						$error = true;
					}
				}else{
					$error = true;
				}
			}else{
				$error = true;
			}
		}else {
			$error = TRUE;
		}
		
		print_r($error);
		
		
		$_SESSION['error'] = $error;
	Header('Location: index.php');
				
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conexion);
?>
