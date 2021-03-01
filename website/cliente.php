<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarDatos.php");
//require_once ("gestionarCliente.php");


	if (!isset($_SESSION['login']))
		Header("Location: login.php");


	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	$dni = $_GET['DNIC'];
	
	$conexion = crearConexionBD();

	$idEmpleado = idEmpleado($conexion, $_SESSION['login']);
	$filas = datosCliente($conexion, $dni);	
	foreach ($filas as $fila) {
		$idcliente = $fila['IDCLIENTE'];
	}
	
	
	
	$idTransportes = viajedni($conexion, $idcliente);
	
	$i = 0;
	$destino = array(array());
	foreach ($idTransportes as $id){					
  				$destino[$i][0] = destino($conexion, $id[0]);
				$destino[$i][1] = $id[1];
				$i++;
	}
	
	
	
	$filas = datosCliente($conexion, $dni);
	cerrarConexionBD($conexion);

?>





<!DOCTYPE html>
<html>
  
<head>
	<title> Perfil cliente </title>
</head>

	
<body>
	
	<?php include_once ("menu.php"); ?>

	<div class="contenido">
  		<!-- Fila 1 -->  
  		<div class="row">
    		<div class="leftcolumn col-6 col-s-6">     
      		
	      		<!-- Información perfil -->
	    		<div class ="card padding1">  	
	      			<div class="size5 blackclass smallercaps"> Perfil cliente </div>
			
					<?php foreach ($filas as $fila) { 
		        	$cliente = $fila['IDCLIENTE'];
					?>
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> Nombre </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php  print_r($fila['NOMBRE']);?>
		          		</div>
		        	</div>
		        	
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> Apellidos </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php  print_r($fila['APELLIDOS']);?>
		          		</div>
		        	</div>
		        	
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> D.N.I. </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php  print_r($fila['DNIC']);?>
		          		</div>
		        	</div>
		        	
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> Fecha nacimiento </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php print_r($fila['FECHANACIMIENTO']);?>
		          		</div>
		        	</div>
		        	
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> Domicilio </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php  print_r($fila['DOMICILIO']);?>
		          		</div>
		        	</div>
		        	
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> Población</span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php  print_r($fila['POBLACION']);?>
		          		</div>
		        	</div>
		        	
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> Email </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php  print_r($fila['EMAIL']);?>
		          		</div>
		        	</div>
		        	
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> Teléfono </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php  print_r($fila['TELEFONO']);?>
		          		</div>
		        	</div>
		        	
		        			
		        	
		        	<?php } ?>
	    		        
					
			
				
  			
  				</div> <!-- end card -->
  				
  				
		    </div> <!-- end leftcolumn -->
	
			<div class="rightcolumn col-6 col-s-6">            	      	 
				<div class="card padding1">		
			      	
			          <div class="size5 smallercaps blackclass">Viajes</div>
			          <div class="margin-left1">
				          <?php 
				            if(!($destino == array(array()))){
				            	foreach ($destino as $d){
				            		foreach ($d[0] as $fd){ 
				            			?>
		  						<div><a href="pagViajes.php?IDVIAJE=<?php echo "$d[1]";?>&IDCLIENTE=<?php echo $idcliente;?>">
		  							<?php print_r($fd[0]); ?></a></div>	  				 	
		  			 		<?php }}
				            }else{ ?>
				            	<div> No hay viajes guardados. </div>
				            <?php } ?>
		            	</div>
		            	<?php 
		foreach ($idEmpleado as $id) {
			$e = $id[0];
		}
	
	?>
	<a class="button button4" href="anyadirViaje.php?IDCLIENTE=<?php echo $cliente; ?>&IDEMPLEADO=<?php echo $e;?>"> Añadir </a>
				</div>
				
				
	
	
				
				<div class="row centered">
					<div class="box col-4 col-s-6 col-xs-8">
				      	<div class="blackclass"> Puntos acumulados </div>
				      	<div>  <?php  print_r($fila['PUNTOSTARJETA']);?></div>
					</div>	
  				</div>
				
				
			</div> <!-- end rightcolumn -->
	
	</div>
	</div>
	
	<?php include_once ("pie.php"); ?>
</body>
</html>
