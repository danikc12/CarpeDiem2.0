<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */
function nuevo_Alojamiento($conexion,$viaje) {
	// para ver si le llega algo o no:print_r($usuario);
	
	
	
	
	
		if($viaje['tipoAl'] == 'apartamento'){
	//		$consulta = "SELECT IDAPARTAMENTO FROM APARTAMENTO WHERE (NOMBRE = '$nombre' AND"
	//	. " LOCALIZACIÓN = '$loc' AND PRECIO = '$precio' AND SERVICIOS = '$servicios' AND"
	//	. " HABITACIÓN = '$habitacion')";
    //	$apartamento = $conexion->query($consulta);
	//	foreach ($apartamento as $id) {
	//		$idApartamento = $id[0];	
	//	}
			
	//		if (!isset($idApartamento)) {
				
			
		try {

		$consulta = "CALL NUEVO_APARTAMENTO(:nombre, :localizacion, :precio, :servicios, :habitacion)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$viaje["nombreAl"]);
		$stmt->bindParam(':localizacion',$viaje["localizacionAl"]);
		$stmt->bindParam(':precio',$viaje["precioAl"]);
		$stmt->bindParam(':servicios',$viaje["serviciosAl"]);
		$stmt->bindParam(':habitacion',$viaje["habitacionAl"]);
		
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
			
	}
	//}else{
	//	return true;
	//}
			// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }elseif($viaje['tipoAl'] == 'hotel'){
    //		$consulta = "SELECT IDHOTEL FROM APARTAMENTO WHERE (NOMBRE = '$nombre' AND"
	//	. " LOCALIZACIÓN = '$loc' AND PRECIO = '$precio' AND SERVICIOS = '$servicios' AND"
	//	. " HABITACIÓN = '$habitacion')";
    //	$hotel = $conexion->query($consulta);
	//	foreach ($hotel as $id) {
	//		$idhotel= $id[0];	
	//	}
		
	//	if (!isset($idApartamento)) {
    	
    	try {

		$consulta = "CALL NUEVO_HOTEL(:nombre, :localizacion, :precio, :servicios, :regimen, :habitacion)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$viaje["nombreAl"]);
		$stmt->bindParam(':localizacion',$viaje["localizacionAl"]);
		$stmt->bindParam(':precio',$viaje["precioAl"]);
		$stmt->bindParam(':servicios',$viaje["serviciosAl"]);
		$stmt->bindParam(':regimen',$viaje["regimenAl"]);
		$stmt->bindParam(':habitacion',$viaje["habitacionAl"]);
		
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
			
	}
		//}ELSE{
		//	RETURN true;
		//}
    }else{
    //	$consulta = "SELECT IDALBERGUE FROM ALBERGUES WHERE (NOMBRE = '$nombre' AND"
	//	. " LOCALIZACIÓN = '$loc' AND PRECIO = '$precio' AND SERVICIOS = '$servicios' AND"
	//	. " HABITACIÓN = '$habitacion')";
    //	$albergue = $conexion->query($consulta);
	//	foreach ($albergue as $id) {
	//		$idAlbergue= $id[0];	
		//}
		//if (!isset($idAlbergue)) {
			
		
    	try {

		$consulta = "CALL NUEVO_ALBERGUE(:nombre, :localizacion, :precio, :servicios, :regimen, :habitacion)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$viaje["nombreAl"]);
		$stmt->bindParam(':localizacion',$viaje["localizacionAl"]);
		$stmt->bindParam(':precio',$viaje["precioAl"]);
		$stmt->bindParam(':servicios',$viaje["serviciosAl"]);
		$stmt->bindParam(':regimen',$viaje["regimenAl"]);
		$stmt->bindParam(':habitacion',$viaje["habitacionAl"]);
		
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
			
	}
		//}else{
		//	return true;
		//}			
	}
    	
    
	
}
//gestion de alojamiento
function nuevo_viajeAlojamiento($conexion,$viaje) {
	// para ver si le llega algo o no:print_r($usuario);
	$idHotel = null;
	$idAlbergue = null;
	$nombre = $viaje['nombreAl'];
	$loc = $viaje['localizacionAl'];
	$precio = $viaje['precioAl'];
	$servicios = $viaje['serviciosAl'];
	$habitacion = $viaje['habitacionAl'];
	$regimen = $viaje['regimenAl'];	
	$fechaI = date('d/m/Y', strtotime($viaje["fechaInAl"]));
	$fechaF = date('d/m/Y', strtotime($viaje["fechaFiAl"]));
	$idHotel= "";
	$idAlbergue = "";
	$idApartamento = ""; 
	
	if($viaje['tipoAl'] == 'apartamento'){
		$consulta = "SELECT IDALBERGUE FROM ALBERGUE WHERE (NOMBRE = '$nombre' AND"
		. " LOCALIZACIÓN = '$loc' AND PRECIO = '$precio' AND SERVICIOS = '$servicios' AND"
		. " HABITACIÓN = '$habitacion')";
    	$apartamento = $conexion->query($consulta);
		foreach ($apartamento as $id) {
			$idApartamento = $id[0];	
		}
			

	}elseif($viaje['tipoAl'] == 'hotel'){
		$consulta2 = "SELECT IDHOTEL FROM HOTELES WHERE (NOMBRE = '$nombre' AND"
		. " LOCALIZACIÓN = '$loc' AND PRECIO = '$precio' AND SERVICIOS = '$servicios' AND"
		. " HABITACIÓN = '$habitacion') ";
    	$hotel = $conexion->query($consulta2);
		foreach ($hotel as $id) {
			$idHotel = $id[0];	
		}
		
		
	}elseif($viaje['tipoAl'] == 'albergue'){
		$consulta3 = "SELECT IDALBERGUE FROM ALBERGUES WHERE (NOMBRE = '$nombre' AND"
		. " LOCALIZACIÓN = '$loc' AND PRECIO = '$precio' AND SERVICIOS = '$servicios' AND"
		. " HABITACIÓN = '$habitacion') ";
    	$albergue = $conexion->query($consulta3);
    	print_r($albergue);
		foreach ($albergue as $id) {
			print_r($id);
			$idAlbergue = $id[0];	
		}
	
	}
	
	
	
	
		try {

		$consulta = "CALL NUEVO_VIAJEALOJAMIENTOS(:fechaI, :fechaF, :idHotel, :idApartamento, :idAlbergue)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':fechaI',$fechaI);
		$stmt->bindParam(':fechaF',$fechaF);
		$stmt->bindParam(':idHotel',$idHotel);
		$stmt->bindParam(':idApartamento',$idApartamento);
		$stmt->bindParam(':idAlbergue',$idAlbergue);
		
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
			
	}
}

//gestion de actividades

function nueva_actividad($conexion,$viaje) {
	// para ver si le llega algo o no:print_r($usuario);
	
	
	$loc = $viaje['localizacionAct'];
	$pre = $viaje['precioAct'];
	$tipo = $viaje['tipoAct'];
	
	
	$consulta = "SELECT IDACTIVIDAD FROM ACTIVIDADES WHERE (LOCALIZACION = '$loc' AND PRECIO = '$pre' AND TIPO = '$tipo') ";
	$actividad = $conexion->query($consulta);
	foreach ($actividad as $id) {
	$idActividad = $id[0];	
	}
	
	if(!isset($idActividad)){
		
	
    	try {

		$consulta = "CALL NUEVA_ACTIVIDAD(:localizacion, :precio, :tipo)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':localizacion',$viaje["localizacionAct"]);
		$stmt->bindParam(':precio',$viaje["precioAct"]);
		$stmt->bindParam(':tipo',$viaje["tipoAct"]);
				
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
			
	}
    }else{
    	return true;
    }	
}
	

function nuevo_viajeActividad($conexion,$viaje) {
	// para ver si le llega algo o no:print_r($usuario);
	$fechaI = date('d/m/Y', strtotime($viaje["fechaInAct"]));
	$fechaF = date('d/m/Y', strtotime($viaje["fechaFiAct"]));
	$loc = $viaje["localizacionAct"];
	$pre = $viaje["precioAct"];
	$tipo = $viaje["tipoAct"];
	
	$consulta = "SELECT IDACTIVIDAD FROM ACTIVIDADES WHERE (LOCALIZACION = '$loc' AND PRECIO = '$pre' AND TIPO = '$tipo') ";
	$actividad = $conexion->query($consulta);
	foreach ($actividad as $id) {
	$idActividad = $id[0];	
	}
	
    	try {

		$consulta = "CALL NUEVO_VIAJEACTIVIDAD(:fechaI, :fechaF, :guía , :idActividad)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':fechaI',$fechaI);
		$stmt->bindParam(':fechaF',$fechaF);
		$stmt->bindParam(':guía',$viaje["guia"]);
		$stmt->bindParam(':idActividad',$idActividad);
				
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
			
	}
    	
}


// gestion de transporte
function nueva_estacion($conexion,$viaje) {
	// para ver si le llega algo o no:print_r($usuario);
	$nombre = $viaje['nombreEst'];
	$codigo = "";
	$tipo = $viaje['tipoEst'];
	$consulta = "SELECT IDESTACION FROM ESTACIONES WHERE (NOMBRE = '$nombre' AND TIPO = '$tipo') ";
	$estacion = $conexion->query($consulta);
	foreach ($estacion as $id) {
	$idEstacion = $id[0];	
	}
	
	if(!isset($idEstacion)){
			
		try {

		$consulta = "CALL NUEVA_ESTACION(:nombre, :codigo, :tipo)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':codigo',$codigo);
		$stmt->bindParam(':tipo',$tipo);
				
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
			
	}

	}else{
		return true;
	}
	
    	    	
}	


function nuevo_transporte($conexion,$viaje) {
	// para ver si le llega algo o no:print_r($usuario);
	$fechaI = date('d/m/Y', strtotime($viaje["fechaInTrans"]));
	$fechaF = date('d/m/Y', strtotime($viaje["fechaFiTrans"]));
	$fechaV = date('d/m/Y', strtotime($viaje["fechaVuelta"]));	
	$nombre = $viaje['nombreEst'];
	$codigo = "";
	$tipo = $viaje['tipoEst'];
	$or = $viaje['origen'];
	$des = $viaje['destino'];
	$co = $viaje['compañia'];
	$pre = $viaje['precioTrans'];
	$IV = $viaje['idaVuelta'];
	
	
	
	$consulta = "SELECT IDESTACION FROM ESTACIONES WHERE (NOMBRE = '$nombre' AND TIPO = '$tipo') ";
	$estacion = $conexion->query($consulta);
	foreach ($estacion as $id) {
		print_r($id[0]);
	$idEstacion = $id[0];	
	}
	
	$consulta2 = "SELECT IDTRANSPORTE FROM TRANSPORTES WHERE (ORIGEN = '$or' AND DESTINO = '$des' AND"
	. " COMPAÑÍA = '$co' AND PRECIONOMINAL = '$pre' AND TIPO = '$IV' AND FECHAI = '$fechaI' AND FECHAF = '$fechaF' AND" 
	. " IDAYVUELTA = '$fechaV' AND IDESTACION = '$idEstacion')";
	$transporte = $conexion->query($consulta2);
	foreach ($transporte as $id) {
	$idTransporte = $id[0];	
	}
	
	if(!isset($idTransporte)){
			try {

		$consulta = "CALL NUEVO_TRANSPORTE(:origen, :destino, :compañia, :precioN , :IV , :fechaI , :fechaF, :fechaV, :idEstacion )";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':origen',$or);
		$stmt->bindParam(':destino',$des);
		$stmt->bindParam(':compañia',$co);
		$stmt->bindParam(':precioN',$pre);
		$stmt->bindParam(':IV',$IV);
		$stmt->bindParam(':fechaI',$fechaI);
		$stmt->bindParam(':fechaF',$fechaF);
		$stmt->bindParam(':fechaV',$fechaV);
		$stmt->bindParam(':idEstacion',$idEstacion);
		
						
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
			
	}
	}else{
		return true;
	}
	
			
	
	
    	    	
}


//gestion de viaje

function nuevo_viaje($conexion,$viaje) {
	// para ver si le llega algo o no:print_r($usuario);
	
	//tansporte
	$o = $viaje['origen'];
	$d = $viaje['destino']; 
	$c = $viaje['compañia'];
	$pt = $viaje['precioTrans'];
	$fechaIT = date('d/m/Y', strtotime($viaje["fechaInTrans"]));
	$fechaFT = date('d/m/Y', strtotime($viaje["fechaFiTrans"]));
	$fechaVT = date('d/m/Y', strtotime($viaje["fechaVuelta"]));
	$iv = $viaje['idaVuelta'];	
	
	//viajeAlojamiento
	
	$nombre = $viaje['nombreAl'];
	$loc = $viaje['localizacionAl'];
	$precio = $viaje['precioAl'];
	$servicios = $viaje['serviciosAl'];
	$habitacion = $viaje['habitacionAl'];
	$regimen = $viaje['regimenAl'];
	if($viaje['tipoAl'] == 'apartamento'){
		$idHotel = null;
		$idAlbergue = null;
		
		
		$consulta = "SELECT IDALBERGUE FROM ALBERGUES WHERE (NOMBRE = '$nombre' AND"
		. " LOCALIZACIÓN = '$loc' AND PRECIO = '$precio' AND SERVICIOS = '$servicios' AND"
		. " HABITACIÓN = '$habitacion')";
    	$apartamento = $conexion->query($consulta);
		foreach ($apartamento as $id) {
			$idApartamento = $id[0];	
		}
			

	}elseif($viaje['tipoAl'] == 'hotel'){
		$idApartamento = null;
		$idAlbergue = null;
		
		$consulta = "SELECT IDHOTEL FROM HOTELES WHERE (NOMBRE = '$nombre' AND"
		. " LOCALIZACIÓN = '$loc' AND PRECIO = '$precio' AND SERVICIOS = '$servicios' AND"
		. " HABITACIÓN = '$habitacion') ";
    	$hotel = $conexion->query($consulta);
		foreach ($hotel as $id) {
			$idHotel = $id[0];	
		}
		
		
	}else{
		$idApartamento = null;
		$idHotel = null;
		
		$consulta = "SELECT IDALBERGUE FROM ALBERGUES WHERE (NOMBRE = '$nombre' AND"
		. " LOCALIZACIÓN = '$loc' AND PRECIO = '$precio' AND SERVICIOS = '$servicios' AND"
		. " HABITACIÓN = '$habitacion') ";
    	$albergue = $conexion->query($consulta);
		foreach ($albergue as $id) {
			$idAlbergue = $id[0];	
		}
	
	}
	$fechaIAl = date('d/m/Y', strtotime($viaje["fechaInAl"]));
	$fechaFAl = date('d/m/Y', strtotime($viaje["fechaFiAl"]));
	
	//viajeActividad
	
	$guia = $viaje['guia'];
	$fechaIAct = date('d/m/Y', strtotime($viaje["fechaInAct"]));
	$fechaFAct = date('d/m/Y', strtotime($viaje["fechaFiAct"]));
	
	$consultaT = "SELECT IDTRANSPORTE FROM TRANSPORTES WHERE (ORIGEN = '$o' AND DESTINO = '$d' AND"
	. " COMPAÑÍA = '$c' AND PRECIONOMINAL = '$pt' AND TIPO = '$iv' AND FECHAI = '$fechaIT' AND FECHAF = '$fechaFT' AND IDAYVUELTA = '$fechaVT') ";
 	$transporte = $conexion->query($consultaT);
	foreach ($transporte as $id) {
	$idTransporte = $id[0];	
	}
	
	if($idHotel!=null){
		$consultaAl = "SELECT IDVIAJEALOJAMIENTO FROM VIAJEALOJAMIENTOS WHERE (FECHAi = '$fechaIAl' AND FECHAf = '$fechaFAl' AND"
		. " IDHOTEL = '$idHotel')";
		$viajeAl = $conexion->query($consultaAl);
		foreach ($viajeAl as $id) {
		$idViajeAl = $id[0];	
		}	
	}elseif($idApartamento != null){
		$consultaAl = "SELECT IDVIAJEALOJAMIENTO FROM VIAJEALOJAMIENTOS WHERE (FECHAi = '$fechaIAl' AND FECHAf = '$fechaFAl' AND"
		. " IDAPARTAMENTO = '$idApartamento')";
		$viajeAl = $conexion->query($consultaAl);
		foreach ($viajeAl as $id) {
		$idViajeAl = $id[0];	
		}
	}elseif($idAlbergue!= null){
		$consultaAl = "SELECT IDVIAJEALOJAMIENTO FROM VIAJEALOJAMIENTOS WHERE (FECHAi = '$fechaIAl' AND FECHAf = '$fechaFAl' AND"
		. " IDALBERGUE = '$idAlbergue')";
		$viajeAl = $conexion->query($consultaAl);
		foreach ($viajeAl as $id) {
		$idViajeAl = $id[0];	
		}
	}
	
	
	
	$consultaAct = "SELECT IDVIAJEACTIVIDAD FROM VIAJEACTIVIDADES WHERE (FECHAI = '$fechaIAct' AND FECHAF = '$fechaFAct' AND GUÍA = '$guia') ";
	$viajeAct = $conexion->query($consultaAct);
	foreach ($viajeAct as $id) {
	$idViajeAct = $id[0];	
	}
	
	//viaje
	
	$fechaIV = date('d/m/Y', strtotime($viaje["fechaIV"]));
	$fechaFV = date('d/m/Y', strtotime($viaje["fechaFV"]));
			
		try {

		$consulta = "CALL NUEVO_VIAJE(:fechaI, :fechaF, :idC, :idE , :idVAct, :idT , :idVAl)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':fechaI',$fechaIV);
		$stmt->bindParam(':fechaF',$fechaFV);
		$stmt->bindParam(':idC',$viaje['cliente']);
		$stmt->bindParam(':idE',$viaje['empleado']);
		$stmt->bindParam(':idVAct',$idViajeAct);
		$stmt->bindParam(':idT',$idTransporte);
		$stmt->bindParam(':idVAl',$idViajeAl);
		
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
			
	}
	
    	    	
}















?>