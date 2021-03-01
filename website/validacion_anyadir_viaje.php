<?php
	session_start();

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		
		//cliente
		$nuevoViaje['cliente'] 
		= $_REQUEST['cliente'];
		//empleado
		$nuevoViaje['empleado'] = $_REQUEST['empleado'];
		
		//viaje
		$nuevoViaje['fechaIV'] = $_REQUEST['fechaIV'];
		$nuevoViaje['fechaFV']=$_REQUEST['fechaFV'];
			
		
		//actividades
		$nuevoViaje['precioAct'] = $_REQUEST['precioAct'];
		$nuevoViaje['localizacionAct'] = $_REQUEST['localizacionAct'];
		$nuevoViaje['tipoAct'] = $_REQUEST['tipoAct'];
		//viajeActividades
		$nuevoViaje['guia'] = $_REQUEST['guia'];
		$nuevoViaje['fechaInAct'] = $_REQUEST['fechaInAct'];
		$nuevoViaje['fechaFiAct'] = $_REQUEST['fechaFiAct'];
		
		//transporte
		$nuevoViaje['origen'] = $_REQUEST['origen'];
		$nuevoViaje['destino'] = $_REQUEST['destino'];
		$nuevoViaje['compañia'] = $_REQUEST['compañia'];
		$nuevoViaje['precioTrans'] = $_REQUEST['precioTrans'];
		$nuevoViaje['fechaInTrans'] = $_REQUEST['fechaInTrans'];
		$nuevoViaje['fechaFiTrans'] = $_REQUEST['fechaFiTrans'];
		$nuevoViaje['idaVuelta'] = $_REQUEST['idaVuelta'];
		$nuevoViaje['fechaVuelta'] = $_REQUEST['fechaVuelta'];
		
		//estacion
		$nuevoViaje['nombreEst'] = $_REQUEST['nombreEst'];
		$nuevoViaje['tipoEst'] = $_REQUEST['tipoEst']; 
		
		//viajeAlojamiento
		$nuevoViaje['fechaInAl'] = $_REQUEST['fechaInAl'];
		$nuevoViaje['fechaFiAl'] = $_REQUEST['fechaFiAl'];
		$nuevoViaje['tipoAl'] = $_REQUEST['tipoAl'];
		$nuevoViaje['nombreAl'] = $_REQUEST['nombreAl'];
		$nuevoViaje['localizacionAl'] = $_REQUEST['localizacionAl'];
		$nuevoViaje['precioAl'] = $_REQUEST['precioAl'];
		$nuevoViaje['serviciosAl'] = $_REQUEST['serviciosAl'];
		$nuevoViaje['regimenAl'] = $_REQUEST['regimenAl'];
		$nuevoViaje['habitacionAl'] = $_REQUEST['habitacionAl'];
		
		
	}
	else // En caso contrario, vamos al formulario
		Header("Location: anyadirViaje.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevoViaje;

	// Validamos el formulario en servidor 
	$errores = validarDatosViaje($nuevoViaje);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: anyadirViaje.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
		Header('Location: accion_nuevo_viaje.php');

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosViaje($nuevoViaje){
		// Validaciones
		if($nuevoViaje["fechaIV"]=="") 
			$errores[] = "<p>La fecha de inicio de viaje no puede estar vacía</p>";
		
		//if(date('d/m/Y',strtotime($nuevoViaje['fechaIV']))< date('d/m/Y',strtotime('today'))){
		//	$errores[] = "<p>La fecha de inicio del viaje no ser menor al día de hoy</p>";
		//}
		
		if($nuevoViaje["fechaFV"]=="") 
			$errores[] = "<p>La fecha de fin de viaje no puede estar vacía</p>";
		
		if($nuevoViaje["precioAct"]=="") 
			$errores[] = "<p>El precio de la actividad no puede estar vacío</p>";
		
		if($nuevoViaje["localizacionAct"]=="") 
			$errores[] = "<p>La localizacion de la actividad no puede estar vacía</p>";
		
		if($nuevoViaje["tipoAct"]=="") 
			$errores[] = "<p>El tipo de actividad no puede estar vacío</p>";
		
		if($nuevoViaje["guia"]=="") 
			$errores[] = "<p>El guía no puede estar vacío</p>";
		
		if($nuevoViaje["fechaInAct"]=="") 
			$errores[] = "<p>La fecha de inicio de la actividad no puede estar vacía</p>";
		
		if($nuevoViaje["fechaFiAct"]=="") 
			$errores[] = "<p>La fecha de fin de la actividad no puede estar vacía</p>";
		
		if($nuevoViaje["precioAct"]=="") 
			$errores[] = "<p>Hay que indicar el precio de la actividad</p>";
		
		if($nuevoViaje["origen"]=="") 
			$errores[] = "<p>El origen del viaje no puede estar vacío</p>";
			
		if($nuevoViaje["destino"]=="") 
			$errores[] = "<p>El destino del viaje no puede estar vacío</p>";
			
		if($nuevoViaje["compañia"]=="") 
			$errores[] = "<p>Hay que indicar la compañía con la que se viaja</p>";
		
		if($nuevoViaje["precioTrans"]=="") 
			$errores[] = "<p>Hay que indicar el precio del transporte</p>";
		
		if($nuevoViaje["fechaInTrans"]=="") 
			$errores[] = "<p>La fecha de salida del transporte no puede estar vacía</p>";
		
		if($nuevoViaje["fechaFiTrans"]=="") 
			$errores[] = "<p>La fecha de llegada a destino del transporte no puede estar vacía</p>";
				
		if($nuevoViaje["idaVuelta"]!="" && $nuevoViaje['fechaVuelta'] =="") 
			$errores[] = "<p>Si el viaje es ida y vuelta de debe indicar la fecha de vuelta</p>";
		
		if($nuevoViaje["fechaInAl"]=="") 
			$errores[] = "<p>La fecha de entrada del alojamiento no puede estar vacía</p>";
		
		if($nuevoViaje["fechaFiAl"]=="") 
			$errores[] = "<p>La fecha de salida del alojamiento no puede estar vacía</p>";
		
		if($nuevoViaje["tipoAl"]=="") 
			$errores[] = "<p>Debe de indicarse el tipo de alojamiento</p>";
			
		if($nuevoViaje["nombreAl"]=="") 
		$errores[] = "<p>Debe indicarse el nombre del alojamiento</p>";
		
		if($nuevoViaje["localizacionAl"]=="") 
		$errores[] = "<p>No puede estar vacío el campo de localizacion de alojamiento</p>";
		
		if($nuevoViaje["precioAl"]=="") 
		$errores[] = "<p>El precio del alojamiento debe indicarse</p>";
		
		if($nuevoViaje["serviciosAl"]=="") 
		$errores[] = "<p>Los servicios del alojamiento no se deben omitir</p>";
		
		if($nuevoViaje['tipoAl']!= 'apartamento' &&$nuevoViaje["regimenAl"]=="") 
		$errores[] = "<p>Si el tipo de alojamiento no es apartamento debe indicarse el regimen</p>";	
	
		return $errores;
	}

?>

