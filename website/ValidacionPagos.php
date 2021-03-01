<?php
	session_start();

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {

		$formulario['cantidad'] = $_REQUEST["cantidad"];
		$formulario['cliente'] = $_REQUEST["cliente"];
		$formulario['viaje'] = $_REQUEST["viaje"];

	}
	else // En caso contrario, vamos al formulario
		Header("Location: pagos.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $formulario;

	// Validamos el formulario en servidor
	$errores = validarPagos($formulario);

	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: pagos.php');
	}else{
		Header('Location: accion_nuevo_pago.php');
	}

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarPagos($formulario){
		$errores = null;
		// Validación de cantidad
		if($formulario["cantidad"]=="")
			$errores = "<p>Tiene que marcar la cantidad </p>";
			
			return $errores;
	}

?>
