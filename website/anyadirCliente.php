<?php
	session_start();

	if (!isset($_SESSION['login']))
		Header("Location: login.php");


	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		$formulario['nif'] = "";
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['domicilio'] = "";
		$formulario['poblacion'] = "";
		$formulario['fechaNacimiento'] = "";
		$formulario['email'] = "";
		$formulario['telefono'] = "";
	
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION['formulario'];
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
	}else if(isset($_SESSION['usuario'])){
		print_r("Guardado");
		unset($_SESSION['usuario']);
		
	}
?>



<!DOCTYPE html>
<html>
	 

<body> 
<?php include 'menu.php'; ?>
	
<div class="contenido">
	<div class="card">
	
		<div class="smalltextTitulos blackclass"> Nuevo cliente </div>
		      
		      	 <?php // Mostrar los erroes de validación (Si los hay)
					if (isset($errores) && count($errores)>0) { 
				    	echo "<div id=\"div_errores\" class=\"error\">";
						echo "<h4> Errores en el formulario:</h4>";
			    		foreach($errores as $error) echo $error; 
			    		echo "</div>";				
			  		}
				 ?>
		         
		         <form id="altaUsuario" method="get" action="validacion_alta_cliente.php" novalidate="">		         			         			         	
		         	<div class="smalltext"> Introduzca los datos </div>
		        	
		        	<div class="row">
                  		<div class="beautybox smalltext centerText blackclass col-4 col-s-4 col-xs-12">
                    		<label for="nombre"> Nombre </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="nombre" name="nombre" placeholder="rellena con el nombre aquí" 
                    		value="<?php echo $formulario['nombre'];?>" required/>
                  		</div>
                	</div>
		        	
		        	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="apellidos"> Apellidos </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="apellidos" name="apellidos" placeholder="rellena con los apellidos aquí" 
                    		value="<?php echo $formulario['apellidos'];?>" required/>
                  		</div>
                	</div>
		
		            <div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="nif"> D.N.I. </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="nif" name="nif" placeholder="12345678X" 
                    		pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['nif'];?>" required/>
                  		</div>
                	</div>
		
					<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="fechaNacimiento"> Fecha nacimiento </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="date" id="fechaNacimiento" name="fechaNacimiento" 
                    		value="<?php echo $formulario['fechaNacimiento'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="domicilio"> Domicilio </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="domicilio" name="domicilio" 
                    		value="<?php echo $formulario['domicilio'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="poblacion"> Población </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="poblacion" name="poblacion" 
                    		value="<?php echo $formulario['poblacion'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="email"> email </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="email" name="email" placeholder="usuario@dominio.extension"
                    		value="<?php echo $formulario['email'];?>" required/>
                  		</div>
                	</div>

		         	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="telefono"> Teléfono </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="telefono" name="telefono" 
                    		value="<?php echo $formulario['telefono'];?>" required/>
                  		</div>
                	</div>
		        	
					<div class="row centered">						
					      <button class="button button4 col-4"> Añadir </button>					      
						
	  				</div>
		         </form>
		
		        
		
	</div>
</div> <!-- end contenido -->
	
	<?php include_once ("pie.php"); ?>

</body>
</html>
