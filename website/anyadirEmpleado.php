<?php
	session_start();
	include_once 'gestionarDatos.php';

	if (!isset($_SESSION['login']))
		Header("Location: login.php");
	


	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION["formulario"])) {
		$formularioE['nif'] = "";
		$formularioE['nombre'] = "";
		$formularioE['apellidos'] = "";
		$formularioE['domicilio'] = "";
		$formularioE['poblacion'] = "";
		$formularioE['fechaNacimiento'] = "";
		$formularioE['email'] = "";
		$formularioE['telefono'] = "";
		$formularioE['cuenta'] = "";
		$formularioE['usuario'] = "";
		$formularioE['clave'] = "";
		$formularioE['confirmClave'] = "";
		$formularioE['rango'] = "";
	
		$_SESSION["formulario"] = $formularioE;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formularioE = $_SESSION['formulario'];
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
	}
?>



<!DOCTYPE html>
<html>
	 

<body> 
<?php 
		include 'menu.php';
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error){
    			echo $error;
			} 
    		echo "</div>";
  		}
	?>




        

		

	
<div class="contenido">
	<div class="card">
	
		<div class="smalltextTitulos blackclass"> Nuevo empleado </div>
		      
		      	 <?php // Mostrar los erroes de validación (Si los hay)
					if (isset($errores) && count($errores)>0) { 
				    	echo "<div id=\"div_errores\" class=\"error\">";
						echo "<h4> Errores en el formulario:</h4>";
			    		foreach($errores as $error) echo $error; 
			    		echo "</div>";					
			  		}
				 ?>
		         
		         <form id="altaUsuario" method="get" action="validacion_alta_empleado.php">		         			         			         	
		         	<div class="smalltext"> Introduzca los datos </div>
		        	
		        	<div class="row">
                  		<div class="beautybox smalltext centerText blackclass col-4 col-s-4 col-xs-12">
                    		<label for="nombre"> Nombre </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="nombre" name="nombre" placeholder="rellena con el nombre aquí" 
                    		value="<?php echo $formularioE['nombre'];?>" required/>
                  		</div>
                	</div>
		        	
		        	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="apellidos"> Apellidos </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="apellidos" name="apellidos" placeholder="rellena con los apellidos aquí" 
                    		value="<?php echo $formularioE['apellidos'];?>" required/>
                  		</div>
                	</div>
		
		            <div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="nif"> D.N.I. </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="nif" name="nif" placeholder="12345678X" 
                    		pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formularioE['nif'];?>" required/>
                  		</div>
                	</div>
		
					<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="fechaNacimiento"> Fecha nacimiento </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="date" id="fechaNacimiento" name="fechaNacimiento" 
                    		value="<?php echo $formularioE['fechaNacimiento'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="domicilio"> Domicilio </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="domicilio" name="domicilio" 
                    		value="<?php echo $formularioE['domicilio'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="poblacion"> Población </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="poblacion" name="poblacion" 
                    		value="<?php echo $formularioE['poblacion'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="telefono"> Teléfono </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="telefono" name="telefono" 
                    		value="<?php echo $formularioE['telefono'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="email"> email </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="email" name="email" placeholder="usuario@dominio.extension"
                    		value="<?php echo $formularioE['email'];?>" required/>
                  		</div>
                	</div>

		         	
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="cuenta"> Cuenta </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="cuenta" name="cuenta" 
                    		value="<?php echo $formularioE['cuenta'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="usuario"> Usuario </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="usuario" name="usuario" 
                    		value="<?php echo $formularioE['usuario'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="clave"> Clave </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="clave" name="clave" 
                    		value="<?php echo $formularioE['clave'];?>" required/>
                  		</div>
                	</div>
		        	
		        	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="confirmClave"> Repetir Clave </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="confirmClave" name="confirmClave" 
                    		value="<?php echo $formularioE['confirmClave'];?>" required/>
                  		</div>
                	</div>
                	
                	<div class="row">
                  		<div class=" beautybox smalltext centerText blackclass col-4 col-s-4">
                    		<label for="rango"> Rango </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<div>
	                    		<label>
									<input name="rango" type="radio" value="1" <?php if($formularioE['rango']=='1') echo 'checked'; ?> />
									Empleado
								</label>
							</div>
							<div>
								<label >
									<input name="rango" type="radio" value="2" <?php if($formularioE['rango']=='2') echo 'checked'; ?> />
									Administrador
								</label>
							</div>
                  		</div>
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
