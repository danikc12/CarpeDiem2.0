<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de libros de la capa de acceso a datos 		
     * #==========================================================#
     */
function consultarTodosClientes($conexion) {
	$consulta = "SELECT * FROM CLIENTES"
		. " ORDER BY NOMBRE, APELLIDOS";
    return $conexion->query($consulta);
}


function datosCliente($conexion, $dni) {
	$consulta = "SELECT * FROM CLIENTES WHERE DNIC = '$dni' ";
    return $conexion->query($consulta);
	}


function viajes($conexion,$cliente){
	$consulta = "SELECT * FROM VIAJES WHERE IDCLIENTE = '$cliente' ";
    return $conexion->query($consulta);
}

function viajedni($conexion,$idcliente){
	$consulta = "SELECT IDTRANSPORTE, IDVIAJE FROM VIAJES WHERE IDCLIENTE = '$idcliente' ";
    return $conexion->query($consulta);
}



function destino($conexion,$viaje){
	$consulta = "SELECT DESTINO  FROM TRANSPORTES WHERE IDTRANSPORTE = '$viaje' ";
    return $conexion->query($consulta);
}

function datosViaje($conexion,$viaje){
	$consulta = "SELECT * FROM VIAJES WHERE IDVIAJE = '$viaje' ";
    return $conexion->query($consulta);
} 

function viajeAlojamiento($conexion,$id){
	$consulta = "SELECT * FROM VIAJEALOJAMIENTOS WHERE IDVIAJEALOJAMIENTO = '$id' ";
    return $conexion->query($consulta);
} 

function viajeActividad($conexion,$id){
	$consulta = "SELECT * FROM VIAJEACTIVIDADES WHERE IDVIAJEACTIVIDAD = '$id' ";
    return $conexion->query($consulta);
} 


function transporte($conexion,$id){
	$consulta = "SELECT * FROM TRANSPORTES WHERE IDTRANSPORTE = '$id' ";
    return $conexion->query($consulta);
} 


function datosAlojamiento($conexion,$id){
	if($id['IDHOTEL'] != null){
		$hotel = $id['IDHOTEL'];
		$consulta = "SELECT * FROM HOTELES WHERE IDHOTEL = '$hotel' ";
    	return $conexion->query($consulta);
	}
	
	if($id['IDAPARTAMENTO'] != null){
		$apartamento = $id['IDAPARTAMENTO'];
		$consulta = "SELECT * FROM APARTAMENTOS WHERE IDAPARTAMENTO = '$apartamento' ";
    	return $conexion->query($consulta);
	}
	if($id['IDALBERGUE'] != null){
		$albergue = $id['IDALBERGUE'];
		$consulta = "SELECT * FROM ALBERGUES WHERE IDALBERGUE = '$albergue' ";
    	return $conexion->query($consulta);
	}
	
} 

function datosActividad($conexion,$id){
	$actividad = $id['IDACTIVIDAD'];
	$consulta = "SELECT * FROM ACTIVIDADES WHERE IDACTIVIDAD = '$actividad' ";
    return $conexion->query($consulta);
} 

function estacion($conexion,$id){
	$estacion = $id['IDESTACION'];
	$consulta = "SELECT * FROM ESTACIONES WHERE IDESTACION = '$estacion' ";
    return $conexion->query($consulta);
} 

function transportes($conexion){
	$hoy = strtotime("today");
	$aux = strtotime('+2 weeks' , $hoy);
	$proximo = date('d/m/Y',$aux);
	$hoy = date('d/m/Y',$hoy);
	$consulta = "SELECT IDTRANSPORTE, IDVIAJE FROM VIAJES WHERE FECHAI BETWEEN '$hoy' AND '$proximo' ";
  	return $conexion->query($consulta);	
}

function getNombre($conexion,$idTansporte){
	$consulta = "SELECT DESTINO FROM TRANSPORTES WHERE IDTRANSPORTE = '$idTransporte'";
    return $conexion->query($consulta);	
}


function idEmpleado($conexion,$email){
	$consulta = "SELECT IDEMPLEADO FROM EMPLEADOS WHERE EMAIL = '$email'";
    return $conexion->query($consulta);		
}

function pagos($conexion,$idCliente,$idViaje){
	$consulta = "SELECT IDPAGO,CANTIDAD, FECHA FROM PAGOS WHERE (IDCLIENTE = '$idCliente' AND IDVIAJE = '$idViaje')";
    return $conexion->query($consulta);
}

function nuevoPago($conexion,$pago,$fecha){
	try {

		$consulta = "CALL NUEVO_PAGO(:cantidad, :fecha, :cliente, :viaje)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':cantidad',$pago["cantidad"]);
		$stmt->bindParam(':fecha',$fecha);
		$stmt->bindParam(':cliente',$pago["cliente"]);
		$stmt->bindParam(':viaje',$pago["viaje"]);
		
		
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

function idClientePorViaje($conexion,$viaje){
	$consulta = "SELECT IDCLIENTE FROM VIAJES WHERE IDVIAJE = '$viaje'";
    return $conexion->query($consulta);
}

function eliminaPago($conexion,$idPago){

	try {
		$borrarPago = "DELETE FROM PAGOS WHERE IDPAGO = :IDPAGO";

		$stmt = $conexion->prepare($borrarPago);
		$stmt->bindParam(':IDPAGO', $idPago);
		$stmt->execute();

		return "";
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
}

function darBaja($conexion,$idEmpleado){
		$date = date('d/m/Y', strtotime('today'));
		try {
		$darBaja = "UPDATE EMPLEADOS SET FECHABAJA = :FECHA WHERE  IDEMPLEADO = :IDEMPLEADO ";

		$stmt = $conexion->prepare($darBaja);
		$stmt->bindParam(':FECHA', $date);
		$stmt->bindParam(':IDEMPLEADO', $idEmpleado);
		$stmt->execute();

		return "";
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}	
	
}

function darAlta($conexion,$idEmpleado){
		$date = date('d/m/Y', strtotime('today'));
		$dateB = "";
		try {
		$darAlta = "UPDATE EMPLEADOS SET FECHAALTA = :FECHA, FECHABAJA = :FECHAB  WHERE  IDEMPLEADO = :IDEMPLEADO ";

		$stmt = $conexion->prepare($darAlta);
		$stmt->bindParam(':FECHA', $date);
		$stmt->bindParam(':FECHAB', $dateB);
		$stmt->bindParam(':IDEMPLEADO', $idEmpleado);
		$stmt->execute();

		return "";
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		print_r($e);
		header("Location: excepcion.php");
	}	
	
	
}
    
?>