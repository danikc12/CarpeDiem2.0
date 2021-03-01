<?php
    include_once 'gestionarDatos.php';
	include_once 'gestionBD.php';
	
	$conexion = crearConexionBD();
	eliminaPago($conexion,1);
	cerrarConexionBD($conexion);
	
?>