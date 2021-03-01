<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarDatos.php");
require_once ("gestionarEmpleados.php");


	if (!isset($_SESSION['login']))
		Header("Location: login.php");


	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = 10;

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);
	
	$email = $_GET['EMAIL'];
	
	$conexion = crearConexionBD();

	$filas = datosEmpleado($conexion, $email); 
	$cargo = consultarCargo($conexion, $email);
	
	cerrarConexionBD($conexion);

?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
	
  <title> Perfil Empleado</title>
</head>
	

<body>
<?php include_once ("menu.php"); ?>
<div class="contenido">
  		<!-- Fila 1 -->  
  		<div class="row">


			<!-- Información perfil -->
	    	<div class ="card padding1">  	
				
						<div class="size5 blackclass smallercaps"> 
				      		&nbsp;<?php if($cargo == 2){
				      		?> Mi perfil <?php
				      		}else{ ?> empleado <?php
				      		}
				      		?>
				  		</div>

				<?php foreach ($filas as $fila) { ?>
		          
		          	
		          	       	
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
		            		<?php  print_r($fila['DNIE']);?>
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
		            		<span class="blackclass"> Fecha alta </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php print_r($fila['FECHAALTA']);?>
		          		</div>
		        	</div>
		        	
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> Fecha baja </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php print_r($fila['FECHABAJA']);?>
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
		        	
		        	<div class="row">
		          		<div class="smalltext centerText blackclass col-4 col-s-4">
		            		<span class="blackclass"> Cuenta </span>
		          		</div>
		          		<div class="centerText col-8 col-s-8">
		            		<?php  print_r($fila['CUENTA']);?>
		          		</div>
		        	</div>
		        	
		        	<div class="centered">
		        		
		        	
		          		<?php 
							if(empty($fila['FECHABAJA'])){ ?>
					
							<a class="button button4 col-6" href="modificarEmpleado.php?ID=1&EMPLEADO=<?php echo $fila['IDEMPLEADO'];?>">
								Dar de baja al empleado</a>
										
						<?php }else{ ?>
					
							<a class="button button4 col-6" href="modificarEmpleado.php?ID=2&EMPLEADO=<?php echo $fila['IDEMPLEADO'];?>">
								Dar de alta al empleado</a>
				
						<?php }
			 		}  ?>
          			</div>
	
	
	
	

</div>
</div>
</div>

<?php include_once ("pie.php"); ?>
</body>
</html>
