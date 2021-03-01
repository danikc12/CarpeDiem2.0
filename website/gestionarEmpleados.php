<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de empleados de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_empleado($conexion,$usuario) {
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
	$fechaAlta = "";
	$fechaBaja = "";
	 print_r($usuario);
	try {
		$consulta = "CALL NUEVO_EMPLEADO(:nombre, :ape,:nif, :fecN, :dom, :pob,  :fecA, :fecB, 0, :email, :tel, :cu, :usu,:pass, :perfil)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nif',$usuario["nif"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dom',$usuario["domicilio"]);
		$stmt->bindParam(':pob',$usuario["poblacion"]);
		$stmt->bindParam(':fecN',$fechaNacimiento);
		$stmt->bindParam(':fecA',$fechaAlta[0]);
		$stmt->bindParam(':fecB',$fechaBaja);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':tel',$usuario["telefono"]);
		$stmt->bindParam(':usu',$usuario["usuario"]);
		$stmt->bindParam(':pass',$usuario["clave"]);
		$stmt->bindParam(':cu',$usuario["cuenta"]);
		$stmt->bindParam(':perfil',$usuario["perfil"]);
		
		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		print_r($e);
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}
 
 function aclualiza_empelado($conexion,$usuario) {
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));

	try {
		$consulta = "CALL ACTUALIZA_EMPLEADO(:nif, :nombre, :ape, :dir, :mun, :fec, :email, :pass, :perfil)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nif',$usuario["nif"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dir',$usuario["calle"]);
		$stmt->bindParam(':mun',$usuario["municipio"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':pass',$usuario["pass"]);
		$stmt->bindParam(':perfil',$usuario["perfil"]);
		
		$stmt->execute();
		
		return asignar_generos_usuario($conexion, $usuario["nif"], $usuario["generoLiterario"]);
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}
 
function consultarEmpleado($conexion,$email,$contraseña) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM EMPLEADOS WHERE EMAIL=:email AND CLAVE=:contraseña";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':contraseña',$contraseña);
	$stmt->execute();
	return $stmt->fetchColumn();
}

//function datosEmpleado($conexion,$email) {
// 	$consulta = "SELECT * FROM EMPLEADOS WHERE EMAIL=:email";
//	$stmt = $conexion->prepare($consulta);
//	$stmt->bindParam(':email',$email);
//	$stmt->execute();
//	return $stmt;
//}

function datosEmpleado($conexion, $email) {
	$consulta = "SELECT * FROM EMPLEADOS WHERE EMAIL = '$email' ";
    return $conexion->query($consulta);
}

function consultarCargo($conexion,$email) {
	 	$consulta = "SELECT IDRANGO AS TOTAL FROM EMPLEADOS WHERE EMAIL=:email " ;
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':email',$email);
		$stmt->execute();
	return $stmt->fetchColumn();
}

