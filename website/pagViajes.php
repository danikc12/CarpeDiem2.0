<!-- PHP -->
<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarDatos.php");
require_once ("gestionarEmpleados.php");


	if (!isset($_SESSION['login']))
		Header("Location: login.php");


	//datos usados para tomar los datos de vuelos del cliente seleccionado	
	//$email = $_GET['EMAIL'];//a cambiar por OID
	
	$conexion = crearConexionBD();
	
	
	$cliente = $_GET['IDCLIENTE'];
	$viaje = $_GET['IDVIAJE'];

	$datosViaje= datosViaje($conexion, $viaje);
	foreach ($datosViaje as $dato) {
		$datoViaje = $dato;
		//print_r($dato);
		$transporte = transporte($conexion, $dato['IDTRANSPORTE']);
		$viajeAlojamiento = viajeAlojamiento($conexion, $dato['IDVIAJEALOJAMIENTO']);
		$viajeActividad = viajeActividad($conexion, $dato['IDVIAJEACTIVIDAD']);
	}
	
	foreach ($viajeAlojamiento as $alojamiento) {
		$aloj = $alojamiento;
		$datosAlojamiento = datosAlojamiento($conexion,$alojamiento);	
	}
	
	
	foreach ($viajeActividad as $actividad) {
		$datosActividad = datosActividad($conexion,$actividad);
	}
	
	foreach ($datosActividad as $activ) {
		$infoActividad = $activ;
	}
	
	foreach ($transporte as $t) {
		$datosTransporte = $t;
	}
	
	foreach ($datosAlojamiento as $alojamiento) {
		$infoAlojamiento = $alojamiento;
	}
	
	$estacion = estacion($conexion, $datosTransporte);
	
	foreach ($estacion as $d) {
		$infoEstacion = $d;
	}
	
	cerrarConexionBD($conexion);


?>


<!DOCTYPE html>
<html>
<head>
	<title> Viaje </title>
</head>

<body>

<!-- Header -->  

<?php include_once ("menu.php"); ?>


<!-- Contenido -->  
<div class="contenido">
  <!-- Fila 1 -->  
  <div class="row">
    <div class="leftcolumn col-6 col-s-6">  
      <!-- Fechas - Viaje -->
      <div class="card size3">        
        <div class="row">          
          <div class="leftcolumn col-6 col-s-12">
                      <span class="blackclass"> Check in: </span> 
                      <span class="right"> <?php print_r($datoViaje['FECHAI']);?> </span>
          </div>
          <div class="rightcolumn col-6 col-s-12 padding-s padding-xs">
                      <span class="blackclass"> Check out: </span>
                      <span class="right"> <?php print_r($datoViaje['FECHAF']);?> </span>
          </div>
        </div>            
      </div> 
    </div>
    <div class="rightcolumn col-6 col-s-12 padding-s padding-xs">
      <div class="card centerText centered  size3" >
        	<!-- Titulo del viaje -->
        	<span> <?php print_r($datosTransporte['DESTINO']) ?>  </span>
      </div> 
    </div>     
  </div>
    
    
  <!-- Fila 2 -->    
  <div class="row">
    <div class="leftcolumn col-6">
      <!-- Alojamiento -->
      <div class="card">
        	<h2>Alojamiento</h2>
			<div class="row">
              <div class="leftcolumn col-s-12">
				<div class="card centered">
	                
                      	<!-- Info - Hotel -->
                  		<?php if(isset($infoAlojamiento['IDHOTEL'])){
                          	print_r("HOTEL");
                          }   
						        if(isset($infoAlojamiento['IDAPARTAMENTO'])){
                          	print_r("APARTAMENTO");
                          }   
						  
						  if(isset($infoAlojamiento['IDALBERGUE'])){
                          	print_r("ALBERGUE");
                          }   
						  ?>
                      
                                 
                  </div>              
                <!-- Direccion - Alojamiento -->
                <h3> <?php print_r($infoAlojamiento['LOCALIZACIÓN'])?> </h3>
              </div>
         
              <div class="rightcolumn col-s-12 padding-s padding-xs">
                  <div class="card centered col-12 col-s12" >
        				<!-- Titulo del viaje -->
        				<span> <?php print_r($infoAlojamiento['NOMBRE']); ?> </span>
      			  </div>
                  <div class="card">
                    <!-- Codigo Google Maps -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.
					9032512307554!2d2.3412579156751296!3d48.879120879289495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.								
					1!3m3!1m2!1s0x47e66e4100bf4017%3A0x9c25d278590df48e!2sPavillon+Opera+Lafayette!5e0!3m2!1ses!2ses!
					4v1556039589149!5m2!1ses!2ses" width="100%" height="30%" frameborder="0" style="border:0"
                    allowfullscreen></iframe>
                  </div>    
              </div>             
          </div>
          <!-- Fechas - Alojamiento -->
          <div class="card">
                  <div class="row">
                      <div class="leftcolumn col-s-12">
                          <span class="blackclass"> Check in: </span>
                          <span class="right">		<?php print_r($aloj['FECHAI']);?></span>
                      </div>
                      <div class="rightcolumn col-s-12 padding-s padding-xs">
                      	  <span class="blackclass"> Check out: </span>
                      	  <span class="right"> <?php print_r($aloj['FECHAF']);?></span>
                      </div>
                  </div>
          </div> 
       </div>
      
      <!-- Actividades -->
      <div class="card">
        <h2>Actividades</h2>
        
        <!-- Tabla -->
        <div class="table" id="results">
          <div class='theader'>
            <div class='table_header'>Nombre</div>
            <div class='table_header'>Desde</div>
            <div class='table_header'>Hasta</div>
            <div class='table_header'>Lugar</div>
          </div>
          
          <?php 
          //foreach($viajeActividad as $actividad){
          	for ($i=0; $i < count($viajeActividad); $i++) { ?>
				  
          	
          <div class='table_row'>
            <div class='table_small'>
              <div class='table_cell'>Guía</div>
              <div class='table_cell'><?php print_r($actividad['GUÍA']);?></div>
            </div>
            <div class='table_small'>
              <div class='table_cell'>Desde</div>
              <div class='table_cell'> <?php print_r($actividad['FECHAI']);?> </div>
            </div>
            <div class='table_small'>
              <div class='table_cell'>Hasta</div>
              <div class='table_cell'><?php print_r($actividad['FECHAF']);?></div>
            </div>
            <div class='table_small'>
              <div class='table_cell'>Lugar</div>
              <div class='table_cell'><?php print_r($infoActividad['LOCALIZACION']);?></div>
            </div>
          </div>
          <?php } ?>
        </div>
        
      
      </div>
    </div>
    <div class="rightcolumn col-6">
      <!-- Transportes -->
      <div class="card">
        <h2>Transportes</h2>
         <div class="row">
           <div class="leftcolumn col-s-12">
              <div class="card centered">
                  
                      
                      <!-- Checkbox4 - Tren -->
                      <?php 
                      	 if($infoEstacion['TIPO'] == "aeropuerto"){
                          	print_r("AEROPUERTO");
                          }   
						 if($infoEstacion['TIPO'] == "estacionBus"){
                          	print_r("BUS");
                          }   
						  
						  if($infoEstacion['TIPO'] == "estacionTren"){
                          	print_r("TREN");
                          }   
						  ?>
                    
                  
              </div>
             
             <!-- Switch - Ida/Vuelta -->
             <div class="card padding2">               
                      
                      	<?php 
                      	if($datosTransporte['TIPO'] == "ida"){
                      		?> 	 
                      				<span class="blackclass"> Ida/Vuelta: </span>
                      	  			<span class="right"> <?php print_r("NO"); ?></span>                      				 
                      			
                      	<?php }else{ ?>
                      			
                      				<span class="blackclass"> Ida/Vuelta: </span>
                      	  			<span class="right"> <?php print_r("SÍ"); ?></span>                      				
                  				
                      	<?php	}
                      
                      	?>
                                            
              </div>
             
             <!-- Fechas - Transportes -->
              <div class="card padding1" >
              	  <div class="leftcolumn col-12 col-s-12">
                      	  <span class="blackclass"> Check in: </span>
                      	  <span class="right"> <?php print_r($datosTransporte['FECHAI']);?></span>
                  </div>
              	  <div class="rightcolumn col-12 col-s-12 nopadding">
                      	  <span class="blackclass"> Check out: </span>
                      	  <span class="right"> <?php print_r($datosTransporte['FECHAF']);?></span>
                  </div>
              </div> 
          </div>
         
          <div class="rightcolumn col-s-12 padding-s padding-xs">
              
      			<div class="card centered col-12 col-s12" >
        			<!-- Titulo del aeropuerto 1 -->
        			<span> <?php print_r($infoEstacion['NOMBRE']); ?>  </span>
      			</div> 
   
              	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3199.8081522543985!2d4.
				496698!3d36.6791135!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd72fa1876ba30a5%3A0x57b5ad2f47de3e9a!
				2sAeropuerto+de+M%C3%A1laga+-+Costa+del+Sol!5e0!3m2!1ses!2ses!4v1556045494432!5m2!1ses!2ses" 
            	width="100%" height="30%" frameborder="0" style="border:0" allowfullscreen></iframe>
                
                <div class="card centered col-12 col-s12" >
        		<!-- Titulo del aeropuerto 2 -->
        		<span> <?php if($infoEstacion['TIPO'] == "aeropuerto"){
                          	print_r("Aeropuerto de "). print_r($datosTransporte['DESTINO']);
                          }   
						 if($infoEstacion['TIPO'] == "estacionBus"){
                          	print_r("Estación de buses de "). print_r($datosTransporte['DESTINO']);
                          }   
						  
						  if($infoEstacion['TIPO'] == "estacionTren"){
                          	print_r("Estación de trenes de "). print_r($datosTransporte['DESTINO']);
                          }   
						  ?>  </span>
      			</div>
            
            	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2617.
				046826643076!2d2.5457304513922376!3d49.00969409789343!2m3!1f0!2f0!3f0!3m2!
				1i1024!2i768!4f13.1!3m3!1m2!1s0x47e63e038e4ccf5b%3A0x42be0982f5ba62c!2s
				Aeropuerto+de+Par%C3%ADs-Charles+de+Gaulle!5e0!3m2!1ses!2ses!4v1556045297864!5m2!1ses!2ses" 
            	width="100%" height="30%" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
          </div>  
        </div>
      
      
      
      	<!-- Pagos -->
      	<button class="button button4"><a href="pagos.php?IDCLIENTE=<?php echo $cliente;?>&IDVIAJE=<?php echo $viaje;?>">Pagos</a>  </button>
      </div>
    </div>
  </div>

    

  <?php include_once ("pie.php"); ?>

</body>
</html>
