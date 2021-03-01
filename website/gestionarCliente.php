<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */
 function alta_cliente($conexion,$usuario) {
	// BUSCA LA OPERACIÓN ALMACENADA "INSERTAR_USUARIO" EN SQL
	// 			PARA SABER CUÁLES SON SUS PARÁMETROS.
	// RECUERDA QUE SE INVOCA MEDIANTE 'CALL' EN PL/SQL
	// RECUERDA QUE EL FORMATO DE FECHA PARA ORACLE ES "d/m/Y"
	// UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO
	// RECUERDA EL TRY/CATCH
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
	// para ver si le llega algo o no:print_r($usuario);
	try {

		$consulta = "CALL NUEVO_CLIENTE(:nombre, :ape, :nif, :fec, :dom, :pob, :email, :foto, 0)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':nif',$usuario["nif"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':dom',$usuario["domicilio"]);
		$stmt->bindParam(':pob',$usuario["poblacion"]);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':tel',$usuario["telefono"]);
		$stmt->bindParam(':foto',$usuario["foto"]);
		
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		echo $e-> getMessage();
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
	
}
	