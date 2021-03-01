<?php
	session_start();

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
				
		$nuevoUsuario["nif"] = $_REQUEST["nif"];
		$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
		$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
		$nuevoUsuario['domicilio'] = $_REQUEST["domicilio"];
		$nuevoUsuario['poblacion'] = $_REQUEST["poblacion"];
		$nuevoUsuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$nuevoUsuario["email"] = $_REQUEST["email"];
		$nuevoUsuario['telefono'] = $_REQUEST["telefono"];
		$nuevoUsuario['cuenta'] = $_REQUEST["cuenta"];
		$nuevoUsuario['usuario'] = $_REQUEST["usuario"];
		$nuevoUsuario["clave"] = $_REQUEST["clave"];
		$nuevoUsuario["confirmClave"] = $_REQUEST["confirmClave"];
		$nuevoUsuario["rango"] = $_REQUEST["rango"];
	}
	else // En caso contrario, vamos al formulario
		Header("Location: anyadirEmpleado.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevoUsuario;

	// Validamos el formulario en servidor 
	$errores = validarDatosUsuario($nuevoUsuario);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: anyadirEmpleado.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
		Header('Location: accion_alta_empleado.php');

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosUsuario($nuevoUsuario){
		// Validación del NIF
		if($nuevoUsuario["nif"]=="") 
			$errores[] = "<p>El NIF no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["nif"])){
			$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["nif"]. "</p>";
		}

		// Validación del Nombre			
		if($nuevoUsuario["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		
		// Validación de Apellidos			
		if($nuevoUsuario["apellidos"]=="") 
			$errores[] = "<p>Los apellidos no puede estar vacío</p>";
		
		// Validación de domicilio
		if($nuevoUsuario["domicilio"]=="") 
			$errores[] = "<p>El domicilio no puede estar vacío</p>";
		
		// Validación de población			
		if($nuevoUsuario["poblacion"]=="") 
			$errores[] = "<p>La población no puede estar vacía</p>";
		
		// Validación de fecha de nacimiento
		if($nuevoUsuario["fechaNacimiento"]=="") 
			$errores[] = "<p>La fecha de nacimiento no puede estar vacío</p>";

		// Validación de cuenta
		if($nuevoUsuario["cuenta"]=="") 
			$errores[] = "<p>La cuenta no puede estar vacía</p>";
		
		// Validación de usuario
		if($nuevoUsuario["usuario"]=="") 
			$errores[] = "<p>El usuario no puede estar vacío</p>";
		
		// Validación de usuario
		if($nuevoUsuario["rango"]=="") 
			$errores[] = "<p>El rango no puede estar vacío</p>";
		
		
		
		// Validación de la contraseña
		if(!isset($nuevoUsuario["clave"]) || strlen($nuevoUsuario["clave"])<8){
			$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		}else if(!preg_match("/[a-z]+/", $nuevoUsuario["clave"]) || 
			!preg_match("/[A-Z]+/", $nuevoUsuario["clave"]) || !preg_match("/[0-9]+/", $nuevoUsuario["clave"])){
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
		}else if($nuevoUsuario["clave"] != $nuevoUsuario["confirmClave"]){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}

		return $errores;
	}

?>

