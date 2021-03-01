<!-- PHP -->
<?php
session_start();

	if (!isset($_SESSION['login']))
		Header("Location: login.php");
	


	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
			
		//cliente
		$formulario['cliente'] = $_GET['IDCLIENTE'];
		$formulario['empleado']	= $_GET['IDEMPLEADO'];
			
		//viaje
		$formulario['fechaIV'] = "";
		$formulario['fechaFV'] = "";	
			
		
		//actividades
		$formulario['precioAct'] = "";
		$formulario['localizacionAct'] = "";
		$formulario['tipoAct'] = "";
		//viajeActividades
		$formulario['guia'] = "";
		$formulario['fechaInAct'] = "";
		$formulario['fechaFiAct'] = "";
		$formulario['precioAct'] = "";
		
		//transporte
		$formulario['origen'] = "";
		$formulario['destino'] = "";
		$formulario['compañia'] = "";
		$formulario['precioTrans'] = "";
		$formulario['fechaInTrans'] = "";
		$formulario['fechaFiTrans'] = "";
		$formulario['idaVuelta'] = "";
		$formulario['fechaVuelta']="";
		
		//estacion
		$formulario['nombreEst']="";
		$formulario['tipoEst'] = ""; 
		
		//viajeAlojamiento
		$formulario['fechaInAl'] = "";
		$formulario['fechaFiAl'] = "";
		$formulario['tipoAl'] = "";
		$formulario['nombreAl'] = "";
		$formulario['localizacionAl'] = "";
		$formulario['precioAl'] = "";
		$formulario['serviciosAl'] = "";
		$formulario['regimenAl'] = "";
		$formulario['habitacionAl'] = "";
				
	
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else{
		$formulario = $_SESSION['formulario'];
	}
		
		
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
	}else if(isset($_SESSION['usuario'])){
		print_r("Guardado");
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title> Añadir Viaje </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="diseno.css">
	
	
</head>


  
<body>


<!-- Header -->  
<?php include_once ("menu.php"); 

if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error card\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}?>


<!-- Contenido -->  
<form id="nuevoViaje" method="post" action="validacion_anyadir_viaje.php" novalidate>
<div class="contenido">
<!--hacer invisibles estos inputs-->
<?php
	if(!isset($_SESSION['formulario'])){?>
	  <input type="hidden" name="cliente" value="<?php echo $_GET['IDCLIENTE'];?>" />
  	  <input type="hidden" name="empleado" value="<?php echo $_GET['IDEMPLEADO'];?>" />
				
	<?php }else{?>
		<input type="hidden" name="cliente" value="<?php echo $formulario['cliente'];?>" />
  		<input type="hidden" name="empleado" value="<?php echo $formulario['empleado'];?>" />
	<?php }?>
  <!-- --- -->
  <!-- Top -->
  <!-- --- -->
  <div class="row">
    <div class="leftcolumn col-6 col-s-6">  
      <div class="card">
      	
        <!-- Fechas - Viaje -->
        <div class="row">          
          <div class="leftcolumn col-s-12">
                      <div > Check in<input type="date" name='fechaIV' value="<?php echo $formulario['fechaIV']?>"></div>
          </div>
          <div class="rightcolumn col-s-12 padding-s padding-xs">
                      <div > Check out<input type="date" name='fechaFV' value="<?php echo $formulario['fechaFV']?>"></div>
          </div>
        </div>            
      </div> 
    </div>
    <div class="rightcolumn col-6 col-s-5">
    </div>     
  </div>
  
  <div class="row">
    <div class="leftcolumn col-5">
      <!-- ----------- -->
      <!-- Alojamiento -->
      <!-- ----------- -->
      <div class="card">
        
        <section class="accordion">
  			<input type="checkbox" name="collapse" id="handle1" checked="checked">
  			<h2 class="handle"><label for="handle1"> Alojamiento </label></h2>
  			<div class="content">
    			<!-- Contenido desplegable - Alojamiento -->

              	<!-- Formulario - Alojamiento -->
                    <div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                            <label for="tipoAl"> Tipo de alojamiento </label>
                        </div>
                        <div class="col-8 col-s-12">
	                       	<div>
		                       	<label>
								<input name="tipoAl" type="radio" value="hotel" <?php  echo ' checked ';?>/>
								Hotel</label>
							</div>
							<div>
								<label>
								<input name="tipoAl" type="radio" value="albergue" <?php if($formulario['tipoAl']=='albergue') echo ' checked ';?>/>
								Albergue</label>
							</div>
							<div>	
								<label>
								<input name="tipoAl" type="radio" value="apartamento" <?php if($formulario['tipoAl']=='apartamento') echo ' checked ';?>/>
								Apartamento</label>
							</div>	
                        </div>
                    </div>
                    <div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                            <label for="nombreAl"> Nombre </label>
                        </div>
                        <div class="col-8 col-s-12 col-xs-12 padding-s padding-xs">
                            <input type="text" id="nombreAl" name="nombreAl" value="<?php echo $formulario['nombreAl'];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                            <label for="localizacionAl"> Localización </label>
                        </div>
                        <div class="col-8 col-s-12 col-xs-12 padding-s padding-xs">
                            <input type="text" id="localizacionAl" name="localizacionAl" value="<?php echo$formulario['localizacionAl'];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                            <label for="precioAl"> Precio </label>
                        </div>
                        <div class="col-8 col-s-12 col-xs-12 padding-s padding-xs">
                            <input type="text" id="precioAl" name="precioAl" value="<?php echo $formulario['precioAl'];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                            <label for="serviciosAl"> Servicios 
                        </div>
                        <div class="col-8 col-s-12 col-xs-12 padding-s padding-xs">
                            <input type="text" id="serviciosAl" name="serviciosAl" value="<?php $formulario['serviciosAl'];?>">
                        </div>
                        </label>
                    </div>
                    <div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                            <label for="regimenAl"> Regimen </label>
                        </div>
                        <div class="col-8 col-s-12 col-xs-12">
                           	<div>
	                            <label for="regimenAl">
								<input name="regimenAl" type="radio" value="soloAlojamiento" <?php echo ' checked ';?>/>
								Solo alojamiento</label>
							</div>
							<div>
								<label for="regimenAl">
								<input name="regimenAl" type="radio" value="pensionCompleta" <?php if($formulario['regimenAl']=='pensionCompleta') echo ' checked ';?>/>
								Pensión completa</label>
							</div>
							<div>
								<input name="regimenAl" type="radio" value="todoIncluido" <?php if($formulario['regimenAl']=='todoIncluido') echo ' checked ';?>/>
								Todo incluido</label>
							</div>
							<div>
								<input name="regimenAl" type="radio" value="mediaPension" <?php if($formulario['regimenAl']=='mediaPension') echo ' checked ';?>/>
								Media Pensión</label>
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                            <label for="habitacionAl"> Habitación </label>
                        </div>
                        <div class="col-8 col-s-12 col-xs-12 padding-s padding-xs">
                            <input type="text" id="habitacionAl" name="habitacionAl" value="<?php echo $formulario['habitacionAl'];?>">
                        </div>
                    </div>
                    
                    <!-- Fechas - Alojamiento -->
                    <div class="card">
                          <div class="row">
                              <div class="leftcolumn col-s-12">
                                    <div> Check in <input type="date" name="fechaInAl" value="<?php echo $formulario['fechaInAl'] ;?>"></div>
                              </div>
                              <div class="rightcolumn col-s-12 padding-s padding-xs">
                                    <div > Check out <input type="date" name="fechaFiAl" value="<?php echo $formulario['fechaInAl']; ?>"></div>
                              </div>
                          </div>
                    </div>                                                       
      		</div>  
		</section>
      </div>
      
      <!-- ----------- -->
      <!-- Actividades -->
      <!-- ----------- -->
      <div class="card">        
        
                
        <section class="accordion">
          <input type="checkbox" name="collapse2" id="handle2">
          <h2 class="handle">
            <label for="handle2"> Actividades </label>
          </h2>
          <div class="content">
            <!-- Contenido desplegable - Actividades -->
            
            <!-- Formulario - ViajeActividades -->
           
                <div class="row">
                  <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                    <label for="guia"> Guía </label>
                  </div>
                  <div class="col-8 col-s-12 padding-s padding-xs">
                    <input type="text" id="guia" name="guia" value="<?php echo $formulario['guia'];?>">
                  </div>
                </div>
              	<!-- Fechas - ViajeActividad -->
                <div class="card">
                  <div class="row">
                    <div class="leftcolumn col-s-12">
                      <div> Fecha inicio <input type="date" name="fechaInAct" value="<?php echo $formulario['fechaInAct'];?>"></div> 
                    </div>
                    <div class="rightcolumn col-s-12 padding-s padding-xs">
                      <div > Fecha fin <input type="date" name="fechaFiAct" value="<?php echo $formulario['fechaFiAct'];?>"></div>
                    </div>
                  </div>
                </div>
                
            
            <!-- Formulario - Actividades -->
                <div class="row">
                  <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                    <label for="precioAct"> Precio </label>
                  </div>
                  <div class="col-8 col-s-12 padding-s padding-xs">
                    <input type="text" id="precioAct" name="precioAct" value="<?php echo $formulario['precioAct'];?>">
                  </div>
                </div>
              
                <div class="row">
                  <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                    <label for="localizacionAct"> Localización </label>
                  </div>
                  <div class="col-8 col-s-12 padding-s padding-xs">
                    <input type="text" id="localizacionAct" name="localizacionAct" value="<?php echo $formulario['localizacionAct'];?>">
                  </div>
                </div>
              
                <div class="row">
                  <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                    <label for="tipoAct"> Tipo </label>
                  </div>
                  <div class="col-8 col-s-12 padding-s padding-xs">
                    <input type="text" id="tipoAct" name="tipoAct" value="<?php echo $formulario['tipoAct'];?>">
                  </div>
                 </div>
                                       
              
                        
          </div>
        </section>

        
      
      </div>
    </div>
    
    
    <div class="rightcolumn col-7">
      <!-- ----------- -->
      <!-- Transportes -->
      <!-- ----------- -->
      <div class="card">                
        <section class="accordion">
          <input type="checkbox" name="collapse3" id="handle3">
          <h2 class="handle">
            <label for="handle3"> Transportes </label>
          </h2>
          <div class="content">
            
            <!-- Contenido desplegable - Transportes -->                    
            <!-- Formulario - Transportes -->
            	<div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
							<label for="tipoEst">	 Tipo de transporte </label>
                        </div>
                        <div class="col-8 col-s-12">
                        	<label for="tipoEst">
							<input name="tipoEst" type="radio" value="aeropuerto" <?php  echo ' checked ';?>/>
							Avión</label>
							<label for="tipoEst">
							<input name="tipoEst" type="radio" value="estacionTren" <?php if($formulario['tipoAl']=='estacionTren') echo ' checked ';?>/>
							Tren</label>
							<label for="tipoEst">
							<input name="tipoEst" type="radio" value="estacionBus" <?php if($formulario['tipoAl']=='estacionBus') echo ' checked ';?>/>
							Bus</label>
                        </div>
                    </div>
                    
                <div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                            <label for="idaVuelta"> Ida y Vuelta </label>
                        </div>
                        <div class="col-8 col-s-12">
                        	<label>
							<input name="idaVuelta" type="radio" value="ida" <?php echo ' checked ';?>/>
						Ida</label>
						<label>
							<input name="idaVuelta" type="radio" value="idaVuelta" <?php if($formulario['idaVuelta']=='idaVuelta') echo ' checked ';?>/>
						IdaVuelta</label>
                        </div>
                    </div>
                
                <div class="row">
                        <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                            <label for="fechaVuelta"> Fecha de la vuelta </label>
                        </div>
                        <div class="col-8 col-s-12 padding-s padding-xs">
                            <input type="date" id="fechaVuelta" name="fechaVuelta" value="<?php echo $formulario['fechaVuelta'];?>"> 
                        </div>
                    </div>    
                    
                    
                <div class="row">
                  <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                    <label for="origen"> Origen </label>
                  </div>
                  <div class="col-8 col-s-12 padding-s padding-xs">
                    <input type="text" id="origen" name="origen" value="<?php echo $formulario['origen'];?>">
                  </div>
                </div>
              
              	<div class="row">
                  <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                    <label for="destino"> Destino </label>
                  </div>
                  <div class="col-8 col-s-12 padding-s padding-xs">
                    <input type="text" id="destino" name="destino" value="<?php echo $formulario['destino'];?>">
                  </div>
                </div>
              
              	<div class="row">
                  <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                    <label for="compañia"> Compañia </label>
                  </div>
                  <div class="col-8 col-s-12 padding-s padding-xs">
                    <input type="text" id="compañia" name="compañia" value="<?php echo $formulario['compañia'];?>">
                  </div>
                </div>

              	<div class="row">
                  <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                    <label for="nombreEst"> Estación </label>
                  </div>
                  <div class="col-8 col-s-12 padding-s padding-xs">
                    <input type="text" id="nombreEst" name="nombreEst" value="<?php echo $formulario['nombreEst'];?>">
                  </div>
                </div>
                
                <div class="row">
                  <div class=" beautybox smalltext centerText blackclass col-4 col-s-12">
                    <label for="precioTrans"> Precio </label>
                  </div>
                  <div class="col-8 col-s-12 padding-s padding-xs">
                    <input type="text" id="precioTrans" name="precioTrans" value="<?php echo $formulario['precioTrans'];?>">
                  </div>
                </div>
	              
              	<!-- Fechas - Transportes -->
                <div class="card">
                  <div class="row">
                    <div class="leftcolumn col-s-12">
                      <div> Fecha inicio <input type="date" name="fechaInTrans" value="<?php echo $formulario['fechaInTrans'];?>"></div>
                    </div>
                    <div class="rightcolumn col-s-12 padding-s padding-xs">
                      <div > Fecha fin <input type="date" name="fechaFiTrans" value="<?php echo $formulario['fechaFiTrans'];?>"></div>
                    </div>
                  </div>
                </div>
              
              
              
            
            
          </div>          
        </section>     
      </div> 
	<button class="button button4"> Añadir </button>
                       
    </form>
      </div>
    </div>
  </div>

    
	<?php include_once ("pie.php"); ?>

  
</body>
</html>


