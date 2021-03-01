<?php
	session_start();

	include_once 'gestionBD.php';
	include_once 'gestionarDatos.php';
	
	if (!isset($_SESSION['login']))
		Header("Location: login.php");
	
	$conexio = crearConexionBD();
	
	$idViaje = $_GET['IDVIAJE'];
	$idCliente = $_GET['IDCLIENTE'];
	$pagos = pagos($conexio,$idCliente,$idViaje);
	
	cerrarConexionBD($conexio);

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		
		$formularioP['viaje'] = "";
		$formularioP['cliente'] = "";
		$formularioP['cantidad'] = "";

		$_SESSION['formulario'] = $formularioP;
	}

	else
		$formularioP = $_SESSION['formulario'];

	// Si hay errores de validación
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
	}else if(isset($_SESSION['pagos'])){
		print_r("Guardado");
	}
	if (isset($_SESSION['borrado'])){
		print_r($_SESSION['borrado']);
	}
	unset($_SESSION['borrado']);
	unset($_SESSION['errores']);
	unset($_SESSION['pagos']);
?>

<!DOCTYPE html>
<html>
<head>
	<title> Pagos </title>
</head>



<body>

<?php include_once ("menu.php"); ?>

<div class="contenido">
	<div class="card">
		<h2>Pagos</h2>
	    <div class="row">
	    	<div >
	            <div class="card">
	          		<!-- Tabla -->
	                <div class="table" id="results">
	                 
	                  <div class='theader'>
	                    <div class='table_header'>Fecha</div>
	                    <div class='table_header'>Cantidad</div>
	                    <div class='table_header'>Opción</div>
	                  </div>
	                  <?php foreach ($pagos as $pago) { ?>
	                  <div class='table_row'>
	                    <div class='table_small'>
	                      <div class='table_cell'>Fecha</div>
	                      <div class='table_cell'><?php echo $pago['FECHA'];?></div>
	                    </div>
	                    <div class='table_small'>
	                      <div class='table_cell'>Cantidad</div>
	                      <div class='table_cell'><?php echo $pago['CANTIDAD'];?></div>
	                    </div>
	                     <div class='table_small'>
	                      <div class='table_cell'>Opción</div>
	                      <div class='table_cell'><a
	                      	 href="borrarPago.php?IDPAGO=<?php echo $pago['IDPAGO'];?>&IDVIAJE=<?php echo $idViaje;?>
	                      	 $IDCLIENTE=<?php echo $idCliente;?>">Borrar</a></div>
	                    </div>
	                    
	                  </div>
	                  <?php }?>
	                </div>
	        		<!-- Fin Tabla -->
					<form id="nuevoPago" method="get" action="ValidacionPagos.php">	
					
	  					<input type="hidden" name="cliente" value="<?php echo $_GET['IDCLIENTE'];?>" />
  	  					<input type="hidden" name="viaje" value="<?php echo $_GET['IDVIAJE'];?>" />
					     			         			         	
		         	<div class="smalltext"> Introduzca los datos </div>
		        	
		        	<div class="row">
                  		<div class="beautybox smalltext centerText blackclass col-4 col-s-4 col-xs-12">
                    		<label for="cantidad"> Cantidad a pagar </label>
                  		</div>
                  		<div class="col-8 col-s-8 col-xs-12 padding-xs">
                    		<input type="text" id="cantidad" name="cantidad" placeholder="Cantidad a pagar" 
                    		value="<?php echo $formularioP['cantidad'];?>" required/>
                    		</label>
                  		</div>
                	</div>
                	<button class="button button4" type="submit">PAGAR</button>
					</form>

	            </div>
	        </div>

	      	





	    </div>
	  </div>
  </div>


	<?php include_once ("pie.php"); ?>


</body>
</html>
