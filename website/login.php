<?php
	session_start();
  	
 	include_once("gestionBD.php");
 	include_once("gestionarEmpleados.php");

	if (!empty($_POST['email'])&&!empty($_POST['contraseña'])){
		$email= $_POST['email'];
		$contraseña = $_POST['contraseña'];
		

		$conexion = crearConexionBD();
		$num_usuarios = consultarEmpleado($conexion,$email,$contraseña);
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0)
			$login = "error";	
		else {
			$_SESSION['login'] = $email;
			$_SESSION['cargo'] = consultarCargo($conexion, $email, $contraseña);
			Header("Location: index.php");
		}	
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset ="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="LoginStyle.css">			
	<title>Login</title>
</head>
<body>	
		
		<div>
			
			<div class="bigbox">
				<!-- Video background -->  
				<video autoplay muted loop id="myVideo">
			      <source src="video.mp4" type="video/mp4">			      
			    </video>				

				
    			<div class="col-4 container">    				
					<?php if (isset($login)) {
						echo "<div class=\"error\">";
						echo "Error en la contraseña o no existe el usuario.";
						echo "<h4>Inténtalo de nuevo.</h4>";
						echo "</div>";						
					}	
					?>  
					
					
    				
    				<form action="login.php" method="post">
    					<!-- Apartado para Usuario -->  
    					<label for="email"><b>Email</b></label>
    					<input type="text" name="email" id="email" placeholder="Introduzca email" required/>
						<!-- Apartado para Contraseña -->  
    					<label for="contraseña"><b>Contraseña</b></label>
   						 </label><input type="password" name="contraseña" id="contraseña" placeholder="Introduzca contraseña" required/>


    					<!-- Boton iniciar sesion -->  
    					<button type="submit" class="button button4"> Iniciar Sesión </button>
    				</form>
  				</div>
  				  				
			</div>
		</div>



</body>
</html>
